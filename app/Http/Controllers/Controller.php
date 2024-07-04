<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Contracts\EsiClientContract;

class Controller extends BaseController
{
    /** @var EsiClientContract $esi */
    protected EsiClientContract $esi;
    
    /**
    * SsoController constructor.
    *
    * @param EsiClientContract $esi
    */
    public function __construct(EsiClientContract $esi)
    {
        $this->esi = $esi;
    }
}