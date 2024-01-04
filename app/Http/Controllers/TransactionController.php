<?php

namespace App\Http\Controllers;

use App\Order;
use App\Transaction;

class TransactionController extends Controller
{
    public function create($id)
    {       
        
        if (!$order = Order::find($id))
            return redirect('thanks')->withErrors(__('Payment failed! Order id :id can not be found.', ['id' => $id]));
        //dd(round($order->nixValidationTotal, 2), round($order->totalToPay, 2));
        $transaction = $order->transactions()->create([
            'type' => $order->nix_validation ? Transaction::TYPE_NIX : Transaction::TYPE_ADDRESSES,
            'amount' => $order->nix_validation ? round($order->nixValidationTotal, 2) : round($order->totalToPay, 2)
        ]);
        
        return redirect('payments/' . $transaction->id . '/' . $order->payment_option);
    }

    public function confirm(BillmateService $billmate)
    {
        $order = new BillmateOrder(request()->data);
        $transaction = Transaction::findByReference($order->get('orderid'));

        if (!$transaction)
            return redirect('oops')
                ->withErrors(__('Transaction is missing. Reference: :id', ['id' => $order->get('orderid')]));

        if ($order->paid())
            return redirect('thanks')
                ->with('flash_message', __('Your payment accepted! Check your mailbox for download link!'))
                ->with('order', $transaction->order);

        if ($order->pending())
            return redirect('thanks')
                ->with('flash_message', __('payment_pending'))
                ->with('order', $transaction->order);

        return redirect('oops')->withErrors(__('Payment failed! Transaction id5555: :id', ['id' => $transaction->id]));
    }

    public function cancel()
    {
        $order = new BillmateOrder(request()->data);
        $transaction = Transaction::findByReference($order->get('orderid'));
        $transaction->status = Transaction::STATUS_FAILED;
        $transaction->save();

        return view('oops')->withErrors(__('Payment failed! Transaction id888: :id', ['id' => $transaction->id]));
    }
}