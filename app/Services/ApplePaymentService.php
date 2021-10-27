<?php

namespace App\Services;

use App\Enums\SubscriptionStatusEnums;
use App\Http\Dtos\DtoInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Subscription\SubscriptionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ApplePaymentService implements PaymentServiceInterface
{
    const PAYMENT_TYPE = 'apple';
    const SUBSCRIPTION_STATUSES_MAP = [
        'INITIAL_BUY' => SubscriptionStatusEnums::NEW,
        'DID_RENEW' => SubscriptionStatusEnums::RENEWED,
        'DID_FAIL_TO_RENEW' => SubscriptionStatusEnums::FAILED_TO_RENEW,
        'CANCEL' => SubscriptionStatusEnums::CANCELLED,
    ];

    /**
     * @var PaymentRepositoryInterface
     */
    private $paymentRepository;
    /**
     * @var SubscriptionRepositoryInterface
     */
    private $subscriptionRepository;

    /**
     * @param PaymentRepositoryInterface $paymentRepository
     * @param SubscriptionRepositoryInterface $subscriptionRepository
     */
    public function __construct(PaymentRepositoryInterface $paymentRepository, SubscriptionRepositoryInterface $subscriptionRepository)
    {
        $this->paymentRepository = $paymentRepository;
        $this->subscriptionRepository = $subscriptionRepository;
    }

    /**
     * @return string
     */
    public function getPaymentType(): string
    {
        return self::PAYMENT_TYPE;
    }

    /**
     * @param DtoInterface $paymentDto
     * @return bool
     */
    public function handle(DtoInterface $paymentDto): bool
    {
        try {
            DB::beginTransaction();
            $subscriptionId = $this->getSubscriptionId($paymentDto->responseBodyV1);
            $this->paymentRepository->create($subscriptionId, $this->getPaymentType(), $paymentDto);
            $this->subscriptionRepository->updateStatus($subscriptionId, $this->getSubscriptionStatus($paymentDto->notificationType));
            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();

            return false;
        }

        return true;
    }

    /**
     * @param string $notificationType
     * @throws \Exception
     * @return string
     */
    protected function getSubscriptionStatus(string $notificationType): string
    {
        if (!isset(self::SUBSCRIPTION_STATUSES_MAP[$notificationType])) {
            throw new \Exception('Wrong status.');
        };

        return self::SUBSCRIPTION_STATUSES_MAP[$notificationType];
    }

    /**
     * @param string $responseBody
     * @return mixed|null
     */
    protected function getSubscriptionId(string $responseBody)
    {
        $decodedBody = json_decode($responseBody);

        return $decodedBody['id'] ?? null;
    }
}
