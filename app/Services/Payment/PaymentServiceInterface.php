<?php

declare(strict_types=1);

namespace App\Services\Payment;

use stdClass;

interface PaymentServiceInterface
{

    public function processPayment(array|stdClass $paymentDetails);
}
