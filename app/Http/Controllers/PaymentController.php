<?php

namespace App\Http\Controllers;

use App\Factories\PaymentDtoFactory;
use App\Services\PaymentServiceInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * @var PaymentDtoFactory
     */
    protected $paymentDtoFactory;
    /**
     * @var PaymentServiceInterface
     */
    protected $paymentService;

    /**
     * @param PaymentDtoFactory $paymentDtoFactory
     * @param PaymentServiceInterface $paymentService
     */
    public function __construct(PaymentDtoFactory $paymentDtoFactory, PaymentServiceInterface $paymentService)
    {
        $this->paymentDtoFactory = $paymentDtoFactory;
        $this->paymentService = $paymentService;
    }


    /**
     * @param Request $request
     * @return void
     */
    public function create(Request $request): void
    {
        $paymentDto = $this->paymentDtoFactory->getInstance($this->paymentService);
        $paymentDto->setProperties($request);

        if (!$this->paymentService->handle($paymentDto)) {
            // TODO: Handle logging error
        }
    }
}
