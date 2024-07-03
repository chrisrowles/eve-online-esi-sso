<?php

namespace Mesa\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

use Mesa\Http\Api\EsiClient;
use Mesa\Http\Api\EsiClientInterface;

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

        Blade::if('esiauth', function () {
            return session()->has('character');
        });

        Blade::if('esicorporate', function () {
            return session()->has('character.corporate_member');
        });
    }
}
