<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface EsiClientContract
{

    public function setURL(string $url): void;

    public function fetch(string $endpoint, string $method = 'GET', bool $isVersioned = true, bool $isAssociated = false): mixed;

    public function getAuthorizationServerURL(array $scopes = []): string;

    public function issueAccessToken(Request $request): mixed;

    public function refreshAccessToken(): void;

    public function verifyAuthorization(): mixed;

    public function fetchCharacterInformation(int $id): mixed;
}
