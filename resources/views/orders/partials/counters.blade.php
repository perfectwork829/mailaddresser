<table class="table table-striped table-bordered table-advance table-hover">
    <tbody>
        <tr>
            <td class="para-color">
                @lang('Price')
            </td>
            <td class="para-color"> {{ number_format($order->price, 2) }} kr @lang('ex VAT')</td>										
        </tr>
        <tr>
            <td class="para-color">
                @lang('Admin Fee')
            </td>
            <td class="para-color"> {{ number_format(setting('admin_fee', 0), 2) }} kr @lang('ex VAT') </td>										
        </tr>
        <tr>
            <td class="para-color">
                @lang('VAT')
            </td>
            <td class="para-color"> {{ number_format($order->vat, 2) }} kr </td>										
        </tr>
        <tr>
            <td class="para-color">
                @lang('Discount')
            </td>
            <td class="para-color"> {{ number_format(($order->discount_percent ? $order->discount_percent : 0), 2) }}% </td>										
        </tr>
    </tbody>
</table>
<h3 class="para-color bold sales-btn">    
    <div class="form-actions">
        @lang('Total to pay')
        <span class="label bg-blue h2"> {{ number_format($order->total_to_pay, 2) }} kr </span>
    </div>    
</h3>  