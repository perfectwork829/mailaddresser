<?php

namespace App;

use App\Exports\AddressesExport;
use App\Jobs\ExportCompleted;
use App\Notifications\NixValidationRequested;
use App\Notifications\Receipt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class Transaction extends Model
{
    const STATUS_CREATED = 0;
    const STATUS_PENDING = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_FAILED = 3;

    const TYPE_ADDRESSES = 0;
    const TYPE_NIX = 1;

    protected $fillable = ['order_id', 'reference', 'data', 'status', 'type', 'amount'];

    protected $casts = ['data' => 'array'];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public static function boot()
    {
        parent::boot();

        
        self::updated(function ($model) {            
            if ($model->status == self::STATUS_SUCCESS) {                
                Notification::route('mail', config('custom.admin_email'))->notify(new Receipt($model));
                Notification::route('mail', $model->order->email)->notify(new Receipt($model));

                if ($model->type == self::TYPE_ADDRESSES) {
                    (new AddressesExport($model->order))->store($model->order->prepareToExport())->chain([
                        new ExportCompleted($model->order, true),
                    ]);
                }

                if ($model->type == self::TYPE_NIX) {
                    Notification::route('mail', config('custom.admin_email'))
                        ->notify(new NixValidationRequested($model->order));
                }
            }else{
                dd('else here updated');
            }
        });

    }

    public static function findByReference($reference)
    {
        return self::where('reference', $reference)->first();
    }
}
