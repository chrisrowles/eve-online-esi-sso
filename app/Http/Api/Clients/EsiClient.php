<?php

namespace Mesa\Http\Api\Clients;

use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * ESI client.
 */
class EsiClient implements EsiClientInterface
{
    /** @var Client $client */
    protected Client $client;

    /** @var string $server */
    protected string $server;

    /** @var string $query */
    protected string $query;

    /** @var string $format */
    protected string $format;

    /** @var array $mappings */
    protected static array $mappings = [];

    /**
     * EsiClient client constructor.
     *
     * @param string|null $server
     */
    public function __construct(string $server = null)
    {
        $this->client = new Client([
            'base_uri' => config('eve.esi.base_uri')
        ]);

        $server = $server ?? config('eve.esi.server');
        $this->server = '?datasource=' . $server;
    }

    /**
     * fetch data from public endpoints.
     *
     * @param string $endpoint
     * @param string $method
     * @return bool|mixed
     */
    public function fetch(string $endpoint = '', string $method = 'GET')
    {
        $endpoint .= $this->server;
        try {
            $response = $this->client->request($method, $endpoint);
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());

            return false;
        }

        if ($response && $response->getStatusCode() === 200)
        {
            return json_decode($response->getBody()->getContents());
        }

        return false;
    }
}
