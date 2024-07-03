<?php

namespace Mesa\Http\Api\Clients;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

/**
 * ESI auth client.
 */
class EsiClient implements EsiClientInterface
{
    /** @var string $server */
    protected string $server;

    /** @var Client $client */
    protected Client $client;

    /** @var string $base */
    protected string $base = 'https://login.eveonline.com';

    /** @var string $code */
    protected string $code;

    /** @var mixed $clientId */
    protected $clientId;

    /** @var mixed $secretKey */
    protected $secretKey;

    /**
     * EsiClient constructor.
     *
     * @param string|null $server
     */
    public function __construct(string $server = null)
    {
        $this->clientId = config('eve.esi.client_id');
        $this->secretKey = config('eve.esi.secret_key');

        $this->client = new Client([
            'base_uri' => $this->base
        ]);

        $server = $server ?? config('eve.esi.server');
        $this->server = '?datasource=' . $server;
    }

    /**
     * Fetch data from endpoints that require authentication.
     *
     * @param string $endpoint
     * @param string $method
     * @return bool|mixed
     */
    public function fetch(string $endpoint = '', string $method = 'GET')
    {
        $endpoint .= $this->server;
        try {

            $options = [];
            if (session('character.access_token')) {
                $options['headers'] = [
                    'Authorization' => 'Bearer ' . session('character.access_token')
                ];
            }

            $response = $this->client->request($method, $endpoint, $options);
        } catch (GuzzleException $e) {
            return false;
        }

        if ($response && $response->getStatusCode() === 200)
        {
            return json_decode($response->getBody()->getContents());
        }

        return false;
    }

    /**
     * Redirect to login to obtain an authorization token.
     *
     * return mixed
     * @param array $scopes
     * @return mixed
     */
    public function getAuthorizationServerURL(array $scopes = [])
    {
        $url = $this->base . '/v2/oauth/authorize?response_type=code';
        $url .= '&redirect_uri=' . urlencode(route('esi.sso.callback'));
        $url .= '&client_id=' . $this->clientId;
        $url .= !empty($scopes) ? $this->buildScopeQueryString($scopes) : '';
        $url .= '&state=' . Str::random();

        return $url;
    }

    /**
     * Callback method to receive the authorization code from EVE SSO
     *
     * @param Request $request
     * @return mixed
     *
     * @throws GuzzleException
     */
    public function callback(Request $request)
    {
        $this->code = $request->get('code');
        return $this->login();
    }

    /**
     * Post login to receive access and refresh tokens.
     *
     * @throws GuzzleException
     */
    public function login()
    {
        $response = $this->client->request('POST', '/v2/oauth/token', [
            'auth' => [
                $this->clientId,
                $this->secretKey
            ],
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $this->code,
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

    /**
     * Refresh access token.
     *
     * @throws GuzzleException
     * @return void
     */
    public function refreshAccessToken()
    {
        $response = $this->client->request('POST', '/v2/oauth/token', [
            'auth' => [
                $this->clientId,
                $this->secretKey
            ],
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => session('character.refresh_token')
            ]
        ]);

        $auth = json_decode($response->getBody()->getContents());
        $expires_on = Carbon::parse(Carbon::now())->addSeconds($auth->expires_in)->toIso8601String();

        session()->put('character.access_token', $auth->access_token);
        session()->put('character.expires_on', $expires_on);
        session()->put('character.refresh_token', $auth->refresh_token);
        session()->save();
    }

    /**
     * Verify login and return character information.
     *
     * @return bool|mixed
     * @throws GuzzleException
     */
    public function verify()
    {
        if (!session('character.access_token'))
        {
            return false;
        }

        $response = $this->client->request('GET', '/oauth/verify', [
            'headers' => [
                'Authorization' => 'Bearer ' . session('character.access_token')
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

    /**
     * Generate query string for ESI scopes.
     *
     * @param array $scopes
     * @return string
     */
    private function buildScopeQueryString(array $scopes)
    {
        $query = '&scope=';
        $count = count($scopes);
        $delim = '%20';
        foreach ($scopes as $name => $key)
        {
            if (--$count <= 0) $delim = null;
            $query .= $key . $delim;
        }

        return $query;
    }
}
