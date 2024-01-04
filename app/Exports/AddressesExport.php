<?php

namespace App\Exports;

use App\Address;
use App\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AddressesExport implements FromCollection, ShouldQueue, WithHeadings, WithCustomCsvSettings
{
    use Exportable;

    public $order;
    private $select = ['name', 'gender', 'streetaddress', 'zipcode', 'town', 'birthdate', 'living'];
    private $phones = ['mobile1', 'mobile2', 'mobile3', 'mobile4', 'phone1', 'phone2', 'phone3'];

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        $select = $this->select;

        if ($this->order->phone_numbers != 'streetAddress') $select = array_merge($select, $this->phones);

        $model = '\App\Address' . ucfirst($this->order->phone_numbers);

        return $model::matchingRecords($this->order)
            ->select($select)
            ->limit($this->order->number_to_purchase)
            ->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return ($this->order->phone_numers != 'streetAddresses') ?
            array_merge($this->select, $this->phones) :
            $this->select;
    }

    /**
     * @inheritDoc
     */
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';',
            'enclosure' => '"'
        ];
    }
}
