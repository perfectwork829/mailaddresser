<div class="cntr">
    <label for="man" class="radio">
        <input type="radio" name="filters[gender]" id="man" class="hidden filters" value="M" {{ $order->gender == 'M' ? 'checked' : '' }}/>
        <span class="label"></span>@lang('Man')
    </label>

    <label for="woman" class="radio">
        <input type="radio" name="filters[gender]" id="woman" class="hidden filters" value="K" {{ $order->gender == 'K' ? 'checked' : '' }}/>
        <span class="label"></span>@lang('Woman')
    </label>

    <label for="both" class="radio">
        <input type="radio" name="filters[gender]" id="both" class="hidden filters" value="0" {{ $order->gender == '0' ? 'checked' : '' }}/>
        <span class="label"></span>@lang('Both')
    </label>
</div>
