<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Mail\Subscribe;
use Mail;


class Subscriber extends Model
{
    // use HasFactory;
    // use LogsActivity;
    

    // /**
    //  * The database table used by the model.
    //  *
    //  * @var string
    //  */
    // protected $table = 'subscribers';

    // /**
    // * The database primary key value.
    // *
    // * @var string
    // */
    // protected $primaryKey = 'id';

    // /**
    //  * Attributes that should be mass-assignable.
    //  *
    //  * @var array
    //  */
    // protected $fillable = ['email'];

    public $fillable = ['email'];
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public static function boot() {
  
        parent::boot();
  
        static::created(function ($item) {
                
            $adminEmail = "superdev829@gmail.com";
            Mail::to($adminEmail)->send(new Subscribe($item));
        });
    }
}
