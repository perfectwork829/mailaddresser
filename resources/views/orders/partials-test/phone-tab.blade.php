<div class="tab_list_wrapper">
    <ul class="tab_list">
        @foreach(\App\Order::$phone_numbers as $key => $val)
            <li class="tab_list_item">
                <input class="styled-checkbox filters" type="radio" name="filters[phone_numbers]" value="{{ $key }}" {{ ($order->phone_numbers == $key) ? 'checked' : '' }}>
                <label for="styled-checkbox" class="category_sub_title">
                    <span>@lang($val)</span>
                </label>
            </li>
        @endforeach
    </ul>
</div>
