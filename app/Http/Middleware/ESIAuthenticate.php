<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Http\Api\ESIClient;
use App\Http\Api\Services\CorporationManagementService;

class ESIAuthenticate
{
    protected ESIClient $esi;

    /**
     * Constructor.
     */
    public function __construct(ESIClient $esi)
    {
        $this->esi = $esi;
    }

    /**
     * Handle request.
     * 
     */
    public function handle($request, Closure $next)
    {
        // dd(session('character'));
        if (! session('character')) {
            return redirect(route('esi.sso.login'));
        }
        
        if (Carbon::parse(session('character.expires_on'))->isPast()) {
            if (session('character.refresh_token')) {
                $this->esi->refreshAccessToken();
            }
        }

        app()->instance(CorporationManagementService::class, session('character'));

        return $next($request);
    }
}
