<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Http\Api\ESIClient;

class ESIAuthenticate
{
    /** @var ESIClient */
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
        if (! session('character')) {
            return redirect(route('esi.sso.login'));
        }
        
        if (Carbon::parse(session('character.expires_on'))->isPast()) {
            if (session('character.refresh_token')) {
                $this->esi->refreshAccessToken();
            }
        }

        return $next($request);
    }
}
