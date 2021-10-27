<?php

namespace App\Factories;

use App\Http\Dtos\Apple\PaymentDto;
use App\Http\Dtos\DtoInterface;
use App\Services\ApplePaymentService;
use App\Services\PaymentServiceInterface;

class PaymentDtoFactory
{
    public function getInstance(PaymentServiceInterface $paymentService): DtoInterface
    {
        switch($paymentService) {
            case $paymentService instanceof ApplePaymentService:
                return new PaymentDto();
        }
    }
}
