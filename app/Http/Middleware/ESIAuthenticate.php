<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Api\Services\CorporationManagementService;

class ESIAuthenticate
{
    public function handle($request, Closure $next)
    {
        if (! session('character')) {
            return redirect(route('esi.sso.login'));
        }

        app()->instance(CorporationManagementService::class, session('character'));

        return $next($request);
    }
}
