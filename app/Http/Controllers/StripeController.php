<?php

namespace App\Http\Controllers;
use Session;
use Stripe;
use App\Transaction;
use Illuminate\Http\Request;
use Stripe\Exception\ApiErrorException;

class StripeController extends Controller
{
    public function index($id)
    {        
        return view('payments.payment', ['id'=> $id]);
    }

    public function stripePost(Request $request, $id)
    {
        try {
            // if (!$transaction = Transaction::where([['id', $id], ['status', Transaction::STATUS_PENDING]])->first()) {
            //     dd(90);
            //     return redirect('thanks')->withErrors(__('Payment failed! Transaction id: :id', ['id' => $id]));
            // }
            
            $transaction = Transaction::where('id', $id)->first();            
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create([
                "amount" => 40,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "This payment is for testing purposes of techsolutionstuff",
            ]);
    
            Session::flash('success', 'Payment Successful!');

            $transaction->status = Transaction::STATUS_SUCCESS;
            $transaction->data = 'Payment Successful!';
            $transaction->save();

            return redirect('thanks')
                ->with('flash_message', __('Your payment accepted!'))
                ->with('order', $transaction->order);

            //return back();
        } catch (ApiErrorException $e) {
            // Handle any Stripe API errors here
            $transaction->status = Transaction::STATUS_FAILED;
            $transaction->data = $e->getMessage();
            $transaction->save();

            return redirect('thanks')->withErrors(__('Payment failed! Transaction id: :id', ['id' => $id]));
        }
    }
}