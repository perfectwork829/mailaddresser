<div class="date_pick">
    <div class="input-daterange input-group">
        <span class="input-group-addon">@lang('From')</span>
        <input type="number" class="input-sm form-control filters" name="filters[age][from]" value="{{ $order->age['from'] }}"/>
        <span class="input-group-addon">@lang('To')</span>
        <input type="number" class="input-sm form-control filters" name="filters[age][to]" value="{{ $order->age['to'] }}"/>
    </div>
</div>
