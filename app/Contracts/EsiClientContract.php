<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface EsiClientContract
{
    /**
     * Set the base URL for the client
     * 
     * @param string $url
     * @return void
     */
    public function setURL(string $url): void;

    /**
     * Fetch data from endpoints that require authentication.
     *
     * @param string $endpoint
     * @param string $method
     * @return mixed
     * @throws ClientException
     */
    public function fetch(string $endpoint, string $method = 'GET', bool $isVersioned = true, bool $isAssociated = false): mixed;

    /**
     * Redirect to login to obtain an authorization token.
     *
     * return mixed
     * @param array $scopes
     * @return string
     */
    public function getAuthorizationServerURL(array $scopes = []): string;

    /**
     * Callback method to receive the authorization code from EVE SSO
     *
     * @param Request $request
     * @return mixed
     *
     * @throws ClientException
     */
    public function issueAccessToken(Request $request): mixed;

    /**
     * Refresh access token.
     *
     * @throws ClientException
     * @return void
     */
    public function refreshAccessToken(): void;

    /**
     * Verify login and return character information.
     *
     * @return bool|mixed
     * @throws ClientException
     */
    public function verifyAuthorization(): mixed;

    /**
     * Fetch publicly accessible character information
     * 
     * @param int $id
     * @return mixed
     */
    public function fetchCharacterInformation(int $id): mixed;

    /**
     * Fetch publicly accessible corporation information
     * 
     * @param int $id
     * @return mixed
     */
    public function fetchCorporationInformation(int $id): mixed;
}
