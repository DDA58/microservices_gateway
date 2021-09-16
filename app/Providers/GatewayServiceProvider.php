<?php

namespace App\Providers;

use App\Services\Gateway;
use Illuminate\Support\ServiceProvider;

class GatewayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('Gateway', 'Gateway');
    }
}
