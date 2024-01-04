<?php

namespace App\Imports;

use App\Order;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OrderExcludes implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $excludes = [];

        foreach ($collection as $item) {
            if (isset($item['phone']) && is_numeric($item['phone']))
                $excludes[] = $item['phone'];
        }

        session(['exclude' => $excludes]);
    }
}
