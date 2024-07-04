<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
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

    public function isApi(Request $request)
    {
        if ($request->ajax() || strtolower($request->header('content-type')) === 'json') {
            return true;
        }

        return false;
    }
}