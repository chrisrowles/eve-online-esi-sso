<?php

namespace Mesa\Http\Controllers\CorporateServices ;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Mesa\Http\Api\EsiClient;
use Mesa\Http\Api\EsiCorporateServices;

class BaseController extends Controller
{
    /** @var EsiCorporateServices $esi */
    protected EsiCorporateServices $esi;

    /** @var EsiClientInterface $auth */
    protected EsiClient $auth;

    /**
     * BaseController constructor.
     *
     * @param EsiClientInterface $auth
     */
    public function __construct(EsiClient $auth)
    {
        $this->auth = $auth;

        $this->middleware(function($request, $next) {
            if (session('character')) {
                $this->esi = new EsiCorporateServices(session('character'));
                if (Carbon::parse(session('character.expires_on'))->isPast()) {
                    $this->auth->refreshAccessToken();
                }

                return $next($request);
            }

            return redirect(route('esi.sso.login'));
        });
    }
}
