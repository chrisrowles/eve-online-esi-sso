<?php

namespace App\Http\Controllers\Corporation;

use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Api\ESIClient;
use App\Http\Api\Services\CorporationManagementService;


class Controller extends BaseController
{
    /** @var CorporationManagementService $esi */
    protected CorporationManagementService $esi;

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
                $this->esi = new CorporationManagementService(session('character'));
                if (Carbon::parse(session('character.expires_on'))->isPast()) {
                    $this->auth->refreshAccessToken();
                }

                return $next($request);
            }

            return redirect(route('esi.corporation.login'));
        });
    }
}
