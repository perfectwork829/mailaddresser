<?php

namespace App\Listeners;

use App\Transaction;
use Ttrig\Billmate\Events\OrderCreated;

class BillmateOrderCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param OrderCreated $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $transaction = Transaction::where([
            ['reference', $event->order->get('orderid')],
            ['status', Transaction::STATUS_PENDING]
        ])->firstOrFail();

        $transaction->data = [$event->order, $event->paymentInfo];

        if ($event->order->paid()) $transaction->status = Transaction::STATUS_SUCCESS;

        $transaction->save();
    }
}
