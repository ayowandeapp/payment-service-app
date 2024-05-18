<?php

namespace Database\Factories;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'payment_platform' => fake()->randomElement(['App\Services\Payment\PaymentServiceOne', 'App\Services\Payment\PaymentServiceTwo']),
            'amount' => rand(1000, 10000),
            'transaction_date' => Carbon::now()->subDay()->addMinutes(rand(0, 1440))
        ];
    }
}
