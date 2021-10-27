<?php

namespace App\Repositories\Subscription;

interface SubscriptionRepositoryInterface
{
    /**
     * @param int $id
     * @param string $status
     * @return bool
     */
    public function updateStatus(int $id, string $status): bool;
}
