<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        // payment repository binding
        $this->app->bind(
            'App\Repositories\User\PaymentRepositoryInterface',
            'App\Repositories\User\PaymentRepository'
        );

        // subscription repository binding
        $this->app->bind(
            'App\Repositories\User\SubscriptionRepositoryInterface',
            'App\Repositories\User\SubscriptionRepository'
        );
    }
}
