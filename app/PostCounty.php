<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCounty extends Model
{
    public function areas()
    {
        return $this->hasMany('App\PostArea', 'county', 'county');
    }

    public function municipalities()
    {
        return $this->hasMany('App\PostArea', 'county', 'county')->groupBy('municipality');
    }
}
