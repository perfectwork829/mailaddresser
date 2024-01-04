<div class="tab_list_wrapper">
    <ul class="tab_list">
        <li class="tab_list_item">
            <input class="styled-checkbox filters" type="checkbox" name="filters[geography][county]" value="1" {{ isset($order->geography['county']) ? 'checked' : '' }}>
            <label for="styled-checkbox" class="category_sub_title">
                <span> <i class="fas fa-angle-down"></i>@lang('County, Municipality')</span>
            </label>

            <ul class="tab_sublist">
                @foreach(\App\PostCounty::with('municipalities')->get() as $val)
                    <li class="tab_sublist_item">
                        <input class="styled-checkbox filters" type="checkbox" name="filters[geography][county][{{ $val->county }}]" value="1" {{ isset($order->geography['county'][$val->county]) ? 'checked' : '' }}>
                        <label for="styled-checkbox" class="category_sub_title">
                            <span> <i class="fas fa-angle-down"></i>{{ $val->county }}</span>
                        </label>
                        <ul class="tab_sublist">
                            @foreach($val->municipalities as $area)
                                <li class="tab_sublist_item">
                                    <input class="styled-checkbox filters" type="checkbox" name="filters[geography][county][{{ $val->county }}][{{ $area->municipality }}]" value="1" {{ isset($order->geography['county'][$val->county][$area->municipality]) ? 'checked' : '' }}>
                                    <label for="styled-checkbox" class="category_sub_title">
                                        <span> {{ $area->municipality }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </li>
        <li class="tab_list_item">
            <input class="styled-checkbox filters" type="checkbox" name="filters[geography][zip]" value="1" {{ isset($order->geography['zip']) ? 'checked' : '' }}>
            <label for="styled-checkbox" class="category_sub_title">
                <span> <i class="fas fa-angle-down"></i>@lang('Zip code')</span>
            </label>
            <ul class="tab_sublist">
                @foreach(\App\PostCode::shortCodes()->get() as $val)
                    <li class="tab_sublist_item">
                        <input class="styled-checkbox filters" type="checkbox" name="filters[geography][zip][{{ $val->code }}]" value="{{ $val->code . ' ' . $val->municipality . ' EOP' . $val->code }}" {{ isset($order->geography['zip'][$val->code]) ? 'checked' : '' }}>
                        <label for="styled-checkbox" class="category_sub_title">
                            <span> <i class="fas fa-angle-down"></i>{{ $val->code . ' ' . $val->municipality . ' EOP' . $val->code }}</span>
                        </label>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
</div>
