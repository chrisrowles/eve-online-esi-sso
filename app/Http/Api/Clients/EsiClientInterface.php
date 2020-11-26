<?php

namespace Mesa\Http\Api\Clients;

interface EsiClientInterface
{
    /**
     * Fetch method for clients.
     *
     * @param string $endpoint
     * @param string $method
     * @return mixed
     */
    public function fetch(string $endpoint, string $method);
}
