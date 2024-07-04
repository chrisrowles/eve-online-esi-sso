<?php

namespace App\Http\Controllers\Applications;

use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Api\EsiClient;
use App\Http\Api\Services\EsiCorporationApplicant;

class Controller extends BaseController
{
    /** @var EsiCorporationApplicant $applicant */
    protected EsiCorporationApplicant $esi;

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
                $this->esi = new EsiCorporationApplicant(session('character'));
                if (Carbon::parse(session('character.expires_on'))->isPast()) {
                    $this->auth->refreshAccessToken();
                }

                return $next($request);
            }

            return redirect(route('esi.sso.login'));
        });
    }
}
