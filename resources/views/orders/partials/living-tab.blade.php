<?php $tempInd = 0; ?>
@foreach(\App\Order::$livings as $key => $val)
<div class="form-group last">																
    <div class="col-md-12 tab_list_item">
        <div class="md-checkbox para-color ">            
            <input class="styled-checkbox filters md-check" id="checkbox3{{$tempInd}}" type="checkbox" name="filters[living_type][{{ $key }}]" value="1" {{ isset($order->living_type[$key]) ? 'checked' : '' }}>
            <label for="checkbox3{{$tempInd}}">            
            @lang($val)</label>
        </div>
    </div>
    <?php $tempInd++;?>
</div>

@endforeach