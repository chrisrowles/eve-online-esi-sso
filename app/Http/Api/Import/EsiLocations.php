<?php

namespace Mesa\Http\Api\Import;

use Mesa\Http\Api\EsiClient;

class EsiLocations extends EsiClient
{
    /** @var string $type */
    protected string $type;

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
     * @return EsiLocations
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
}
