<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Contracts\ESIClientContract;

class Controller extends BaseController
{
    /** @var ESIClientContract $esi */
    protected ESIClientContract $esi;
    
    /**
    * SSOController constructor.
    *
    * @param ESIClientContract $esi
    */
    public function __construct(ESIClientContract $esi)
    {
        $this->esi = $esi;
        $this->esi->setURL(config('eve.esi.api_uri'));
    }
}