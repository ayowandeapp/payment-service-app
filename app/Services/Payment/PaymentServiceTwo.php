<?php

namespace App\Services\Payment;

use stdClass;

class PaymentServiceTwo implements PaymentServiceInterface
{

    public function processPayment(array|stdClass $paymentDetails)
    {
        /// Business logic for payment two here
        return 'payment two';
    }
}
