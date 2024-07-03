<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use App\Contracts\EsiClientContract;
use App\Http\Api\EsiClient;
use App\Http\Api\Import\EsiLocations;

class EsiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            EsiClientContract::class,
            EsiClient::class
        );

        $this->app->bind(
            'esi.locations',
            EsiLocations::class
        );

        Blade::if('esiauth', function () {
            return Session::has('character');
        });
    }
}
