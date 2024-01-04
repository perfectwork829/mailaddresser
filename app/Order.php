<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use function Clue\StreamFilter\fun;

class Order extends Model
{
    const STATUS_CREATED = 0;
    const STATUS_PAYED = 1;
    const STATUS_EXPORTING = 2;
    const STATUS_EXPORTED = 3;
    const STATUS_DOWNLOADED = 4;

    const PAYMENT_OPTION_PAYSON = 'payson';
    const PAYMENT_OPTION_INVOICE = 'invoice';
    const PAYMENT_OPTION_BILLMATE = 'billmate';
    const PAYMENT_OPTION_STRIPE = 'stripe';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'matching_records', 'number_to_purchase', 'discount_code',
        'path', 'gender', 'age', 'geography', 'living_type', 'phone_numbers', 'exclude', 'first_name',
        'last_name', 'company_name', 'organization_number', 'email', 'phone', 'postal_address', 'message',
        'zip', 'area', 'payment_option', 'status', 'nix_validation',
    ];

    protected $hidden = ['path'];

    protected $casts = [
        'age' => 'array',
        'geography' => 'array',
        'living_type' => 'array',
        'exclude' => 'array',
        'nix_validation' => 'boolean'
    ];

    protected $attributes = [
        'phone_numbers' => 'streetAddress'
    ];

    public static $livings = [
//        'äganderätt' => 'Ownership',
        'bostadsrätt' => 'Condominium',
//        'hus' => 'House',
        'hyresrätt' => 'Tenancy',
//        'kedjehus' => 'Detached',
//        'lantbruk' => 'Agriculture',
//        'radhus' => 'Terraced',
//        'tomträtt' => 'Long lease',
        'villa' => 'Villa'
    ];

    public static $phone_numbers = [
        'streetAddress' => 'I don\'t need phone numbers, only addresses',
        'phone' => 'I want all people with a phone number',
        'fixedLandLine' => 'I only want people that have a FIXED land line',
        'mobile' => 'I only want people who have a MOBILE phone'
    ];

    public static $payment_options = [
        'invoice' => 'Invoice',
        // 'payson' => 'Payson',
        // 'billmate' => 'Billmate',
        'stripe' => 'Stripe',
    ];

    public static $statuses = [
        0 => 'Created',
        1 => 'Payed',
        2 => 'Exporting',
        3 => 'Exported',
        4 => 'Downloaded',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    public function getNixValidationPriceAttribute()
    {
        if (!isset($this->attributes['number_to_purchase'])) return null;

        return
            setting('nix_validation_admin_fee', 800) +
            $this->attributes['number_to_purchase'] * setting('nix_validation_price', 0.25);
    }

    public function getNixValidationVatAttribute()
    {
        if (!isset($this->nixValidationPrice)) return 0;

        return $this->nixValidationPrice * setting('vat_percent', 25) / 100;
    }

    public function getNixValidationTotalAttribute()
    {
        if (!isset($this->nixValidationPrice)) return 0;

        return $this->nixValidationPrice + $this->nixValidationVat;
    }

    public function getPriceAttribute()
    {
        if (!isset($this->attributes['number_to_purchase']))
            return null;

        $phone_is_required = true;

        if (isset($this->attributes['phone_numbers']) && ($this->attributes['phone_numbers'] == 'streetAddress'))
            $phone_is_required = false;

        $price = $this->getRecordPrice($this->attributes['number_to_purchase'], $phone_is_required);

        $price = $price * $this->attributes['number_to_purchase'];

        return $price;

    }

    public function getVatAttribute()
    {
        if (!isset($this->price)) return 0;

        $price = $this->price + setting('admin_fee', 0);

        if ($this->discountPercent) $price -= $price * $this->discountPercent / 100;

        return $price * setting('vat_percent', 25) / 100;
    }

    public function getTotalToPayAttribute()
    {
        if (!isset($this->price)) return 0;

        $price = $this->price + setting('admin_fee', 0);

        if ($this->discountPercent) $price -= $price * $this->discountPercent / 100;

        return $price + $this->vat;
    }

    public function prepareToExport()
    {
        $path = 'orders/' . $this->id . '/' . time() . rand(10000, 99999) . '.xlsx';

        $this->path = $path;
        $this->status = Order::STATUS_EXPORTING;

        $this->save();

        return $path;
    }

    public function getDiscountPercentAttribute()
    {
        if (!isset($this->attributes['discount_code'])) return 0;
        if ($discount = Discount::where('code', $this->attributes['discount_code'])->first())
            return $discount->amount;

        return 0;
    }

    public function getRecordPrice($number, $phoneIsRequired = true)
    {
        $type = $phoneIsRequired ? Price::TYPE_WITH_PHONE_NUMBERS : Price::TYPE_ONLY_ADDRESSES;

        $price = Price::where('from_number', '<=', $number)
            ->where('to_number', '>=', $number)
            ->where('type', $type)->first();

        if (!$price) return null;

        return $price->price;
    }

    public function getNixPriceAttribute()
    {
        if (!isset($this->attributes['number_to_purchase'])) return null;
        $price = $this->attributes['number_to_purchase'] *
            setting('nix_validation_price', 0.25) +
            setting('nix_validation_admin_fee', 800);

        $vat = $price * setting('vat_percent', 25) / 100;

        return $price + $vat;
    }
}
