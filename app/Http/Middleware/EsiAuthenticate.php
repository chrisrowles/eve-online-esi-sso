<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Api\EsiCorporationManagement;

class EsiAuthenticate
{
    public function handle($request, Closure $next)
    {
        if (! session('character')) {
            return redirect(route('esi.sso.login'));
        }

        app()->instance(EsiCorporationManagement::class, session('character'));

        return $next($request);
    }
}
