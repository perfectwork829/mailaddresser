<?php

namespace App\Jobs;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;

class ExportCompleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;
    public $notify_user;

    /**
     * Create a new job instance.
     *
     * @param Order $order
     * @param bool $notify_user
     */
    public function __construct(Order $order, $notify_user = false)
    {
        $this->order = $order;
        $this->notify_user = $notify_user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->order->status = Order::STATUS_EXPORTED;
        $this->order->save();
        if ($this->notify_user)
            Notification::route('mail', $this->order->email)
                ->notify(new \App\Notifications\ExportCompleted($this->order));
    }
}
