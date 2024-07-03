<?php

namespace Mesa\Import;

use Illuminate\Support\Facades\Log;
use Mesa\Http\Api\Import\EsiLocations;
use Mesa\Models\Region;
use Mesa\Models\Constellation;
use Mesa\Models\System;
use Mesa\Models\Stargate;
use Mesa\Models\Station;

class Locations extends AbstractImporter
{
    /** @var EsiLocations $esi */
    private EsiLocations $esi;

    /**
     * Locations constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->esi = new EsiLocations();
    }

    /**
     * Import regions.
     *
     * @return array
     */
    public function regions() {

        $this->esi->setType('regions');
        $regions = $this->esi->getData();

        $total = count($regions);
        $count = 0;
        $errors = 0;
        if ($total > 0)
        {
            foreach ($regions as $id)
            {
                if (Region::where('region_id', $id)->first() === null)
                {
                    $data = $this->esi->getData($id);

                    $region = new Region();
                    $region->region_id = $data->region_id;
                    $region->name = $data->name;
                    $region->description = $data->description ?? '';

                    if ($region->save())
                    {
                        ++$count;
                    } else {
                        Log::error('Failed to import region: ' . $id);
                        ++$errors;
                    }
                } else {
                    --$total;
                }
            }
        }

        return [
            'regions' => $total,
            'imported' => $count,
            'errors' => $errors
        ];
    }

    /**
     * Import constellations.
     *
     * @return array
     */
    public function constellations() {
        $this->esi->setType('constellations');

        $constellations = $this->esi->getData();
        $total = count($constellations);
        $count = 0;
        $errors = 0;
        if ($total > 0)
        {
            foreach ($constellations as $id)
            {
                if (Constellation::where('constellation_id', $id)->first() === null)
                {
                    $data = $this->esi->getData($id);

                    $constellation = new Constellation();
                    $constellation->region_id = $data->region_id;
                    $constellation->constellation_id = $data->constellation_id;
                    $constellation->name = $data->name;

                    if ($constellation->save())
                    {
                        ++$count;
                    } else {
                        Log::error('Failed to import contellation: ' . $id);
                        ++$errors;
                    }
                } else {
                    --$total;
                }
            }
        }

        return [
            'constellations' => $total,
            'imported' => $count,
            'errors' => $errors
        ];
    }

    /**
     * Import systems.
     *
     * @return array
     */
    public function systems() {
        $this->esi->setType('systems');

        $systems = $this->esi->getData();
        $total = count($systems);
        $count = 0;
        $errors = 0;
        if ($total > 0)
        {
            foreach ($systems as $id)
            {
                if (System::where('system_id', $id)->first() === null)
                {
                    $data = $this->esi->getData($id);

                    $system = new System();
                    $system->constellation_id = $data->constellation_id;
                    $system->system_id = $data->system_id;
                    $system->name = $data->name;
                    $system->security_class = $data->security_class ?? '';
                    $system->security_status = $data->security_status ?? '';

                    if ($system->save())
                    {
                        ++$count;
                    } else {
                        Log::error('Failed to import system: ' . $id);
                        ++$errors;
                    }
                } else {
                    --$total;
                }
            }
        }

        return [
            'systems' => $total,
            'imported' => $count,
            'errors' => $errors
        ];
    }

    /**
     * Import stargates.
     *
     */
    public function stargates() {
    }

    /**
     * Import stations.
     *
     */
    public function stations() {}
}
