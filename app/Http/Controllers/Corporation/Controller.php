<?php

namespace App\Http\Controllers\Corporation;

use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Api\EsiClient;
use App\Http\Api\Services\EsiCorporationManagement;


class Controller extends BaseController
{
    /** @var EsiCorporationManagement $esi */
    protected EsiCorporationManagement $esi;

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
            if (session('character')) {
                $this->esi = new EsiCorporationManagement(session('character'));
                if (Carbon::parse(session('character.expires_on'))->isPast()) {
                    $this->auth->refreshAccessToken();
                }

                return $next($request);
            }

            return redirect(route('esi.corporation.login'));
        });
    }
}
