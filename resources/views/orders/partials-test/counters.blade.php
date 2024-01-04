<div class="right-price-box">
    <div class="right-price-box_list">
        <span class="price_title">@lang('Price')</span>
        <span class="price_value">{{ number_format($order->price, 2) }} kr @lang('ex VAT')1212</span>
    </div>

    <div class="right-price-box_list">
        <span class="admin_fee_title">@lang('Admin Fee')</span>
        <span class="price_value">{{ number_format(setting('admin_fee', 0), 2) }} kr @lang('ex VAT')1212</span>
    </div>

    <div class="right-price-box_list">
        <span class="vat_title">@lang('VAT')</span>
        <span class="vat_value">{{ number_format($order->vat, 2) }} kr</span>
    </div>

    <div class="right-price-box_list">
        <span class="discount_title">@lang('Discount')</span>
        <span class="discount_value">{{ number_format(($order->discount_percent ? $order->discount_percent : 0), 2) }}%</span>
    </div>
</div>

<div class="total_price">
    <span class="total_price_title">@lang('Total to pay')</span>
    <span class="total_price_value" data-price="{{ $order->total_to_pay }}">{{ number_format($order->total_to_pay, 2) }} kr</span>
</div>
