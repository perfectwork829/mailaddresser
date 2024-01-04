<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Omnipay\Omnipay;

class PaysonController extends Controller
{
    public function create($id)
    {
        $transaction = Transaction::findOrFail($id);

        $gateway = Omnipay::create('Payson_ApiV1');
        $gateway->initialize(config('services.payson'));

        try {
            $response = $gateway->purchase([
                'returnUrl' => url('/payson/' . $transaction->id . '/confirm'),
                'notifyUrl' => url('/payson/' . $transaction->id . '/notify'),
                'cancelUrl' => url('/payson/' . $transaction->id . '/cancel'),
                'currency' => 'sek',
                'memo' => $transaction->id,
                'amount' => $transaction->amount,
                'guaranteeOffered' => 'NO'
            ])->send();
        } catch (\Throwable $e) {
            $transaction->status = Transaction::STATUS_FAILED;
            $transaction->data = $e->getMessage();
            $transaction->save();

            return redirect('thanks')->withErrors(__('Payment failed! Transaction id: :id', ['id' => $transaction->id]));
        }

        if ($response->isRedirect()) {
            $transaction->status = Transaction::STATUS_PENDING;
            $transaction->data = $response->getData();
            $transaction->reference = $response->getTransactionReference();
            $transaction->save();

            $response->redirect();
        } else {
            return redirect()->back()->withErrors(__('Payment failed! Transaction id: :id', ['id' => $transaction->id]));
        }
    }

    public function confirm($id)
    {
        if (!$transaction = Transaction::where([['id', $id], ['status', Transaction::STATUS_PENDING]])->first())
            return redirect('thanks')->withErrors(__('Payment failed! Transaction id: :id', ['id' => $id]));

        $gateway = Omnipay::create('Payson_ApiV1');
        $gateway->initialize(config('services.payson'));

        try {
            $response = $gateway->completePurchase([
                'transactionReference' => $transaction->reference
            ])->send();
        } catch (\Throwable $e) {
            $transaction->status = Transaction::STATUS_FAILED;
            $transaction->data = $e->getMessage();
            $transaction->save();

            return redirect('thanks')
                ->with('order', $transaction->order)
                ->withErrors(__('Payment failed! Transaction id: :id', ['id' => $transaction->id]));
        }
        if ($response->isSuccessful()) {
            $transaction->status = Transaction::STATUS_SUCCESS;
            $transaction->data = $response->getData();
            $transaction->save();

            return redirect('thanks')
                ->with('flash_message', __('Your payment accepted!'))
                ->with('order', $transaction->order);
        }

        $transaction->status = Transaction::STATUS_FAILED;
        $transaction->data = $response->getData();
        $transaction->save();

        return redirect('thanks')
            ->with('order', $transaction->order)
            ->withErrors(__('Payment failed! Transaction id: :id', ['id' => $transaction->id]));
    }

    public function cancel($id)
    {
        return redirect('thanks')->withErrors(__('Payment failed! Transaction id: :id', ['id' => $id]));
    }

    public function notify(Request $request)
    {
        Log::info('notify received', $request->all());
        return ['status' => 'ok'];
    }
}
