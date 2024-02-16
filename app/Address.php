<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Address extends Model
{
    use LogsActivity;

    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'addresses';

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
    protected $fillable = [
        'name', 'gender', 'mobile1', 'mobile2', 'mobile3', 'mobile4', 'phone1', 'phone2', 'phone3',
        'streetaddress', 'zipcode', 'town', 'birthdate', 'living'
    ];

    public function scopeMatchingRecords($query, $order)
    {
        if ($order->gender) $query->where('gender', $order->gender);
        if ($order->age) {
            if($order->age['from']!=0 || $order->age['to']!=0){
                if ($order->age['from']) $query->where('birthdate', '<', date('Ymd', strtotime($order->age['from'] . ' years ago')))->where('birthdate', '!=', 0);
                if ($order->age['to']) $query->where('birthdate', '>', date('Ymd', strtotime($order->age['to'] . ' years ago')));
            }            
        }
        if ($order->geography) {
            $postCodes = PostCode::select('code');
            $municipalities = [];
            $counties = [];

            if (isset($order->geography['county'])) {
                foreach ($order->geography['county'] as $key => $val) {
                    if (is_array($order->geography['county'][$key])) {
                        $municipalities = array_merge($municipalities, array_keys($order->geography['county'][$key]));
                    } else {
                        $counties[] = $key;
                    }
                }
            };
            if (isset($order->geography['zip'])) {
                foreach ($order->geography['zip'] as $key => $val)
                    $postCodes->orWhere('code', 'like', "$key%");
            }
            $postCodes->orWhereIn('municipality', $municipalities)
                ->orWhereIn('county', $counties);

            $query->joinSub($postCodes, 'pc', function ($join) {
                $join->on('zipcode', '=', 'pc.code');
            });
        }
        if ($order->living_type)
            $query->where(function ($q) use ($order) {
                $q->whereIn('living', array_keys($order->living_type));
            });

        if (!empty($order->exclude)) $query->excludeNumbers($order->exclude);
    }

    public function scopeExcludeNumbers($query, $excludes)
    {
        $query->whereNotIn('id', function ($q) use ($excludes) {
            $q->select('id')->from(self::getTable())
                ->whereIn('mobile1', $excludes)
                ->orWhereIn('mobile2', $excludes)
                ->orWhereIn('mobile3', $excludes)
                ->orWhereIn('mobile4', $excludes)
                ->orWhereIn('phone1', $excludes)
                ->orWhereIn('phone2', $excludes)
                ->orWhereIn('phone3', $excludes);
        });
    }

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
