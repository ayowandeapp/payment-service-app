<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\Payment\PaymentServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    //

    public function processPayment(Request $r, PaymentServiceInterface $paymentService)
    {
        $validator = Validator::make($r->all(), [
            'amount' => 'required|regex:/^[0-9]*$/i',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        }

        // Retrieve the validated input...
        $validated = $validator->validated();

        $paymentDetails = $validated;
        $result = $paymentService->processPayment($paymentDetails);

        // Save transaction
        Transaction::create([
            'payment_platform' => get_class($paymentService),
            'amount' => $paymentDetails['amount'],
            'transaction_date' => now(),
        ]);

        // return response()->json($result);
        return redirect('/')->with('success', 'Payment processed successfully');
    }

    public function getReport(Request $r)
    {
        if (Transaction::count() < 10) Artisan::call('db:seed --class=TransactionSeeder');
        $period = $r->input('period', 'daily');
        $transactions = Transaction::query();

        switch ($period) {
            case 'daily':
                $transactions->whereDate('transaction_date', now());
                break;
            case 'monthly':
                $transactions->whereMonth('transaction_date', now()->month);
                break;
            case 'yearly':
                $transactions->whereYear('transaction_date', now()->year);
                break;
        }

        return view('dashboard', ['transactions' => $transactions->paginate(5)->appends(['period' => $period]), 'period' => $period]);
    }
}
