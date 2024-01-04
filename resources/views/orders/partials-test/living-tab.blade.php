<div class="tab_list_wrapper">
    <ul class="tab_list">
        @foreach(\App\Order::$livings as $key => $val)
            <li class="tab_list_item">
                <input class="styled-checkbox filters" type="checkbox" name="filters[living_type][{{ $key }}]" value="1" {{ isset($order->living_type[$key]) ? 'checked' : '' }}>
                <label for="styled-checkbox" class="category_sub_title">
                    <span>@lang($val)</span>
                </label>
            </li>
        @endforeach
    </ul>
</div>
