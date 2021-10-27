<?php

namespace App\Repositories\Payment;

use App\Http\Dtos\DtoInterface;
use App\Models\Payment;

interface PaymentRepositoryInterface
{
    /**
     * @param int $subscriptionId
     * @param string $paymentType
     * @param DtoInterface $paymentDto
     * @return Payment
     */
    public function create(int $subscriptionId, string $paymentType, DtoInterface $paymentDto): Payment;
}
