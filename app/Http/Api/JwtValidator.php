<?php

namespace Mesa\Http\Api;

use Exception;
use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use Mesa\Http\Api\EsiClient;

class JwtValidator extends EsiClient
{    
    /**
     * Validate JWT tokens from ESI
     * 
     * @param mixed $token
     * @return StdClass $decoded
     * @throws Exception
     */
    public function validate($token)
    {
        $this->setURL(config('eve.esi.login_uri'));

        $jwks = $this->fetch('/oauth/jwks', 'GET', false, true);

        if (!$jwks) {
            throw new Exception('Unable to fetch JWKS');
        }
        
        $keys = JWK::parseKeySet($jwks);
        
        try {
            $decoded = JWT::decode($token, $keys);

            // Validate the issuer
            if ($decoded->iss !== config('eve.esi.login_uri')) {
                throw new Exception('Invalid issuer');
            }
            
            // Validate the expiry date
            if ($decoded->exp < time()) {
                throw new Exception('Token has expired');
            }
            
            // Validate the audience
            if (!in_array($this->clientId, $decoded->aud) || !in_array('EVE Online', $decoded->aud)) {
                throw new Exception('Invalid audience');
            }
            
            return $decoded;
        } catch (Exception $e) {
            // Handle validation errors
            throw new Exception('Token validation failed: ' . $e->getMessage());
        }
    }
}