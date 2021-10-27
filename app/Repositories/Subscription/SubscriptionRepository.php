<?php

namespace App\Repositories\Subscription;

use App\Models\Subscription;

class SubscriptionRepository implements SubscriptionRepositoryInterface
{
    /**
     * @var Subscription
     */
    protected $subscription;

    /**
     * @param Subscription $subscription
     */
    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    public function updateStatus(int $id, string $status): bool
    {
        $subscription = $this->subscription->find($id);

        if ($subscription) {
            return $subscription->update(['status']);
        }

        return false;
    }
}
