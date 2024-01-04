<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostCode extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = 'code';

    public function scopeShortCodes($query)
    {
        return $query->groupBy(DB::raw('left(code, 2)'))->selectRaw('left(code, 2) as code, municipality');
    }
}
