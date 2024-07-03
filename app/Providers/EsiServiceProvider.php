<?php

namespace Mesa\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

use Mesa\Http\Api\EsiClient;
use Mesa\Http\Api\EsiClientInterface;
use Mesa\Http\Api\Import\EsiLocations;

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
            EsiClientInterface::class,
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
