<?php

namespace Mesa\Http\Controllers\CorporateManagement;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Mesa\Http\Api\Clients\EsiAuthClient;
use Mesa\Http\Api\EsiCorporateManagement;


class BaseController extends Controller
{
    /** @var EsiCorporateManagement $esi */
    protected EsiCorporateManagement $esi;

    /** @var EsiAuthClient $auth */
    protected EsiAuthClient $auth;

    /**
     * BaseController constructor.
     *
     * @param EsiAuthClient $auth
     */
    public function __construct(EsiAuthClient $auth)
    {
        $this->auth = $auth;

        $this->middleware(function($request, $next) {
            if (session('character'))
            {
                $this->initializeEsi();
                if (Carbon::parse(session('character.expires_on'))->isPast())
                {
                    $this->auth->refreshAccessToken();
                }

                return $next($request);
            }

            return redirect(route('esi.corporate.login'));
        });
    }

    /**
     * Initialize an ESI instance.
     */
    public function initializeEsi() : void
    {
        $this->esi = new EsiCorporateManagement(session('character'));
    }
}
