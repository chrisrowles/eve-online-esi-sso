<?php

namespace Mesa\Http\Controllers\CorporateManagement;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Mesa\Http\Api\EsiClient;
use Mesa\Http\Api\EsiCorporateManagement;


class BaseController extends Controller
{
    /** @var EsiCorporateManagement $esi */
    protected EsiCorporateManagement $esi;

    /** @var EsiClient $auth */
    protected EsiClient $auth;

    /**
     * BaseController constructor.
     *
     * @param EsiClient $auth
     */
    public function __construct(EsiClient $auth)
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
