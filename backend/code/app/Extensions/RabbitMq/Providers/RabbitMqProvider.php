<?php

namespace app\Extensions\RabbitMq\Providers;

use App\Extensions\RabbitMq\RabbitMQ;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class RabbitMqProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(RabbitMQ::class, function (Application $app) {
            return new RabbitMQ();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
