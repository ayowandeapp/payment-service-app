<?php

namespace App\Providers;

use App\Services\Payment\PaymentServiceFactory;
use App\Services\Payment\PaymentServiceInterface;
use App\Services\Payment\PaymentServiceOne;
use App\Services\Payment\PaymentServiceTwo;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //only one instance of the service is created and shared throughout the lifecycle of the app
        $this->app->singleton(PaymentServiceOne::class);
        $this->app->singleton(PaymentServiceTwo::class);

        $this->app->singleton(PaymentServiceFactory::class, function ($app) {
            return new PaymentServiceFactory(
                app()->make(PaymentServiceOne::class),
                app()->make(PaymentServiceTwo::class)
            );
        });

        //resolve a new instance of the service each time since it must run health checks and may get the same or another 
        $this->app->bind(PaymentServiceInterface::class, function ($app) {
            return $app->make(PaymentServiceFactory::class)->getPaymentService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
