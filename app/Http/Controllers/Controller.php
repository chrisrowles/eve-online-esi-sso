<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Contracts\EsiClientContract;
use App\Http\Api\JwtValidator;

class Controller extends BaseController
{
    /** @var EsiClientContract $esi */
    protected EsiClientContract $esi;
    
    /** @var JwtValidator $validator */
    protected JwtValidator $validator;
    
    /**
    * SsoController constructor.
    *
    * @param EsiClientContract $esi
    */
    public function __construct(EsiClientContract $esi, JwtValidator $validator)
    {
        $this->esi = $esi;
        $this->validator = $validator;
    }
}