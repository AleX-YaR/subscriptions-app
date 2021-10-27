<?php

namespace App\Services;

use App\Http\Dtos\DtoInterface;

interface PaymentServiceInterface
{
    /**
     * @return string
     */
    public function getPaymentType(): string;

    /**
     * @param DtoInterface $paymentDto
     * @return bool
     */
    public function handle(DtoInterface $paymentDto): bool;
}
