<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Support\Facades\Log;
use Ttrig\Billmate\Article as BillmateArticle;
use Ttrig\Billmate\Order as BillmateOrder;
use Ttrig\Billmate\Service as BillmateService;

class BillmateController extends Controller
{
    public function index(BillmateService $billmate, $id)
    {        
        $transaction = Transaction::where([['id', $id], ['status', Transaction::STATUS_CREATED]])->firstOrFail();
        $transaction->status = Transaction::STATUS_PENDING;
        $transaction->save();

        $articles = collect()->push(new BillmateArticle([
            'title' => $transaction->order->nix_validation ? 'nix validation' : 'addresses',
            'price' => $transaction->amount,
        ]));

        try {
            $checkout = $billmate->initCheckout($articles);
            $transaction->data = $checkout;
            $transaction->reference = $checkout->get('orderid');
            $transaction->save();
            
        } catch (\Throwable $e) {
            $transaction->status = Transaction::STATUS_FAILED;
            $transaction->data = $e->getMessage();
            $transaction->save();

            return view('oops')->withErrors(__('Payment failed! Transaction id3333: :id', ['id' => $transaction->id]));
        }

        return view('billmate', compact('checkout'));
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
