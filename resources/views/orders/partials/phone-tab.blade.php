<div class="form-group">
    <div class="col-md-12 tab_list_wrapper">
        <div class="md-radio-list tab_list">
            <?php $tempInd = 0; ?>
            @foreach(\App\Order::$phone_numbers as $key => $val)
            <div class="md-radio para-color tab_list_item">                
                <input class="styled-checkbox md-radiobtn filters" id="radio{{$tempInd}}" type="radio" name="filters[phone_numbers]" value="{{ $key }}" {{ ($order->phone_numbers == $key) ? 'checked' : '' }}>
                <label for="radio{{$tempInd}}">
                    @lang($val)
                </label>
            </div>
            <?php $tempInd++;?>
            @endforeach          																	
        </div>
    </div>
</div>