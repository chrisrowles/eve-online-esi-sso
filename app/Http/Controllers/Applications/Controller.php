<?php

namespace App\Http\Controllers\Applications;

use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Api\ESIClient;
use App\Http\Api\Services\CorporateApplicantService;

class Controller extends BaseController
{
    /** @var CorporateApplicantService $applicant */
    protected CorporateApplicantService $esi;

    /** @var ESIClient $auth */
    protected ESIClient $auth;

    /**
     * BaseController constructor.
     *
     * @param ESIClient $auth
     */
    public function __construct(ESIClient $auth)
    {
        $this->auth = $auth;

        $this->middleware(function($request, $next) {
            if (session('character')) {
                $this->esi = new CorporateApplicantService(session('character'));
                if (Carbon::parse(session('character.expires_on'))->isPast()) {
                    $this->auth->refreshAccessToken();
                }

                return $next($request);
            }

            return redirect(route('esi.sso.login'));
        });
    }
}
