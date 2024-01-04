<?php

namespace App\Imports;

use App\Address;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AddressesImport implements ToCollection, WithBatchInserts, WithChunkReading,
    ShouldQueue, WithCustomCsvSettings
{

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        $addresses = [];
        foreach ($rows as $row) {

                $addresses[] = [
                    'name' => !empty($row[1]) ? $row[1] : '',
                    'gender' => !empty($row[2]) ? $row[2] : '',
                    'mobile1' => !empty($row[3]) && $row[3][1] == 7 ? $row[3] : '',
                    'mobile2' => !empty($row[4]) && $row[4][1] == 7 ? $row[4] : '',
                    'mobile3' => !empty($row[5]) && $row[5][1] == 7 ? $row[5] : '',
                    'mobile4' => !empty($row[6]) && $row[6][1] == 7 ? $row[6] : '',
                    'phone1' => !empty($row[7]) ? $row[7] : '',
                    'phone2' => !empty($row[8]) ? $row[8] : '',
                    'phone3' => !empty($row[9]) ? $row[9] : '',
                    'streetaddress' => !empty($row[10]) ? $row[10] : '',
                    'zipcode' => !empty($row[11]) ? $row[11] : 0,
                    'town' => !empty($row[12]) ? $row[12] : '',
                    'birthdate' => !empty($row[13]) ? $row[13] : 0,
                    'living' => !empty($row[14]) ? $row[14] : '',
                ];
        }
        Address::insert($addresses);
    }

    public function batchSize(): int
    {
        return 1000;
    }
    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';',
            'enclosure' => '"'
        ];
    }
}
