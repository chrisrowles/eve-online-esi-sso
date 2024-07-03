<?php

namespace Mesa\Http\Api;

use Mesa\Http\Api\EsiClient;

/**
 * ESI Corporate Services.
 */
class EsiCorporateServices extends EsiClient
{
    /** @var mixed $token */
    private $token;

    /** @var mixed $id */
    public $id;

    /** @var mixed $name */
    private $name;

    /** @var string $base */
    protected string $base = 'https://esi.evetech.net';

    /** @var array $data */
    protected array $data = [];

    /**
     * EsiCorporateServices constructor.
     *
     * @param array $character
     */
    public function __construct(array $character)
    {
        $this->token = $character['access_token'];
        $this->id = $character['id'];
        $this->name = $character['name'];

        parent::__construct();
    }

    /**
     * Plan a journey route.
     *
     * @param $origin
     * @param $destination
     * @return bool|mixed
     */
    public function planJourneyRoute($origin, $destination)
    {
        return $this->fetch('/latest/route' . $origin, $destination);
    }
}
