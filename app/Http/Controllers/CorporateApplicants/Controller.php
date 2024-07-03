<?php

namespace Mesa\Http\Controllers\CorporateApplicants;

use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use Mesa\Http\Api\EsiClient;
use Mesa\Http\Api\EsiCorporateApplicant;

class Controller extends BaseController
{
    /** @var EsiCorporateApplicant $aplicant */
    protected EsiCorporateApplicant $esi;

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
                $this->esi = new EsiCorporateApplicant(session('character'));
                if (Carbon::parse(session('character.expires_on'))->isPast()) {
                    $this->auth->refreshAccessToken();
                }

                return $next($request);
            }

            return redirect(route('esi.sso.login'));
        });
    }
}
