<?php

namespace App\Http\Api;

use App\Http\Api\EsiClient;

/**
 * ESI Applicant Management.
 */
class EsiCorporationApplicant extends EsiClient
{

    /** @var mixed $id */
    public $id;

    /** @var mixed $name */
    private $name;

    /** @var array $data */
    protected array $data = [];

    /**
     * EsiCorporationApplicant constructor.
     *
     * @param $character
     */
    public function __construct($character)
    {
        $this->setURL(config('eve.esi.api_uri'));

        $this->id = $character['id'];
        $this->name = $character['name'];

        parent::__construct();
    }

    /**
     * Obtain information required for character applications.
     *
     * @return mixed
     */
    public function getInfoRequiredForApplication()
    {
        $this->data[$this->id] = ['name' => $this->name];

        $corpHistory = $this->getCorporationHistory();
        if ($corpHistory)
        {
            foreach ($corpHistory as $corp)
            {
                $information = $this->fetch('/corporations/' . $corp->corporation_id);

                if ($information)
                {
                    $this->data[$this->id]['corporation_history'][$information->name] = ['since' => $corp->start_date];
                    $this->data[$this->id]['current_corporation'] = key($this->data[$this->id]['corporation_history']);
                }
            }
            $this->data[$this->id]['contacts'] = $this->getContacts();
        }

        return $this->data[$this->id];
    }

    /**
     * Get applicant corporation history.
     *
     * @return bool|mixed
     */
    private function getCorporationHistory()
    {
        return $this->fetch('/characters/'.$this->id.'/corporationhistory/');
    }


    /**
     * Get applicant contacts.
     *
     * @return bool|mixed
     */
    private function getContacts()
    {
        return $this->fetch('/characters/'.$this->id.'/contacts/');
    }
}
