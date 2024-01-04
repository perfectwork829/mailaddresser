<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostArea extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = 'city';

    public function county()
    {
        return $this->belongsTo('App\PostCounty', 'county', 'county');
    }
}
