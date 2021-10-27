<?php

namespace App\Http\Dtos\Apple;

use App\Http\Dtos\DtoInterface;
use Illuminate\Http\Request;

class PaymentDto implements DtoInterface
{
    public $notificationType;
    public $responseBodyV1;

    public function setProperties(Request $request): void
    {
        $this->notificationType = $request->notification_type;
        $this->responseBodyV1 = $request->responseBodyV1;
    }
}
