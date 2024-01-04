<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Price extends Model
{
    use LogsActivity;

    const TYPE_ONLY_ADDRESSES = '0';
    const TYPE_WITH_PHONE_NUMBERS = '1';

    public static $types = [0 => 'Only Addresses', 1 => 'With Phone Numbers'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'prices';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['from_number', 'to_number', 'type', 'price'];



    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " model has been {$eventName}";
    }
}
