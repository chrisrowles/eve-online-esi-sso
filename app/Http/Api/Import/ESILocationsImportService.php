<?php

namespace App\Http\Api\Import;

use App\Http\Api\ESIClient;

class ESILocationsImportService extends ESIClient
{
    /** @var string $type */
    protected string $type;

    /**
     * ESILocationsImportService constructor
     */
    public function __construct()
    {
        $this->setURL(config('eve.esi.api_uri'));
        parent::__construct();
    }

    /**
     * Fetch data from the ESI.
     *
     * @param int|null $id
     * @return bool|mixed
     */
    public function getData(int $id = null)
    {
        $endpoint = '/universe/' . $this->type;
        if (!is_null($id))
        {
            $endpoint .= '/' . $id;
        }

        return $this->fetch($endpoint);
    }

    /**
     * Set location type for the ESI.
     *
     * @param mixed $type
     * @return ESILocationsImportService
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
}
