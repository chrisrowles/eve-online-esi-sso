<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use App\Contracts\ESIClientContract;
use App\Http\Api\ESIClient;
use App\Http\Api\Import\ESILocationsImportService;

class ESIServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            ESIClientContract::class,
            ESIClient::class
        );

        $this->app->bind(
            'esi.locations',
            ESILocationsImportService::class
        );

        Blade::if('_esi_authenticated', function () {
            return Session::has('character');
        });

        Blade::if('_esi_corporate_access', function () {
            return Session::has('character');
        });
    }
}
