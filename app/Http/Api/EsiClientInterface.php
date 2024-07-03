<?php

namespace Mesa\Http\Api;

interface EsiClientInterface
{
    /**
     * Fetch method for clients.
     *
     * @param string $endpoint
     * @param string $method
     * @param bool $isVersioned
     * @param bool $isAssociated
     * @return mixed
     */
    public function fetch(string $endpoint, string $method, bool $isVersioned, bool $isAssociated);
}
