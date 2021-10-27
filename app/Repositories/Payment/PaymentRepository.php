<?php

namespace App\Repositories\Payment;

use App\Http\Dtos\DtoInterface;
use App\Models\Payment;

class PaymentRepository implements PaymentRepositoryInterface
{
    /**
     * @var Payment
     */
    protected $payment;

    /**
     * @param Payment $payment
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * @param int $subscriptionId
     * @param string $paymentType
     * @param DtoInterface $paymentDto
     * @return Payment
     */
    public function create(int $subscriptionId, string $paymentType, DtoInterface $paymentDto): Payment
    {
        return $this->payment->create([
            'subscriptionId' => $subscriptionId,
            'paymentType' => $paymentType,
            'type' => $paymentDto->notificationType,
            'body' => $paymentDto->notificationType,
        ]);
    }
}
