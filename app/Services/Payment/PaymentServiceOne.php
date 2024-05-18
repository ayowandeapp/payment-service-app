<?php

namespace App\Services\Payment;

use stdClass;

class PaymentServiceOne implements PaymentServiceInterface
{

    public function processPayment(array|stdClass $paymentDetails)
    {
        /// Business logic for payment one here
        return 'payment one';
    }
}
