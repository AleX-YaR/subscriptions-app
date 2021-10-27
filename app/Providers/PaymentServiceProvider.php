<?php

namespace App\Providers;

use App\Services\ApplePaymentService;
use App\Services\PaymentServiceInterface;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * @return void
     */
    public function register()
    {
        $this->app->bind(PaymentServiceInterface::class, ApplePaymentService::class);
        $this->app->bind(PaymentServiceInterface::class, AndroidPaymentService::class);
    }
}
