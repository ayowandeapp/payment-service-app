<?php

namespace App\Services\Payment;

class PaymentServiceFactory
{

    // protected $serviceOne;

    // protected $serviceTwo;

    public function __construct(protected PaymentServiceOne $serviceOne, protected PaymentServiceTwo $serviceTwo)
    {
    }

    public function getPaymentService()
    {
        //health check
        $serviceOneDown = $this->isserviceOneDown();
        $serviceTwoDown = $this->isserviceTwoDown();

        if ($serviceOneDown && !$serviceTwoDown) {
            return $this->serviceTwo;
        } elseif (!$serviceOneDown && $serviceTwoDown) {
            return $this->serviceOne;
        } else {
            return config('payment.default') == 'ServiceOne' ? $this->serviceOne : $this->serviceTwo;
        }
    }

    protected function isserviceOneDown()
    {
        // Implement actual logic to check 
        return false; // Placeholder
    }

    protected function isServiceTwoDown()
    {
        // Implement actual logic to check 
        return false; // Placeholder
    }
}
