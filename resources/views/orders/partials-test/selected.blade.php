<div class="your_choices">

    <div class="your_choices_title">
        @lang('Your Choices')
    </div>

    <ul class="your_choices_list">
        <li>
            <div class="category_wrapper">
                <div class="your_choices_category_title">
                    @lang('Gender')
                </div>
                <div class="count_and_more">
                    <span class="choices_count {{ ($order->gender != null) ? '' : 'null_counts' }}">{{ ($order->gender != null) ? 1 : 0 }}</span>
                    <span class="expander"> <i class="fas fa-angle-down"></i> </span>
                </div>
            </div>

            @if($order->gender != null)            
                <ul class="your_choices_sublist">
                    <li>
                        <input data-tab="gender" name="selected[gender]" class="styled-checkbox selected" type="radio" value="M" {{ $order->gender == 'M' ? 'checked' : '' }}>
                        <label for="styled-checkbox" class="category_sub_title">@lang('Man')</label>
                    </li>
                    <li>
                        <input data-tab="gender" name="selected[gender]" class="styled-checkbox selected" type="radio" value="K" {{ $order->gender == 'K' ? 'checked' : '' }}>
                        <label for="styled-checkbox" class="category_sub_title">@lang('Woman')</label>
                    </li>
                    <li>
                        <input data-tab="gender" name="selected[gender]" class="styled-checkbox selected" type="radio" value="0" {{ $order->gender == '0' ? 'checked' : '' }}>
                        <label for="styled-checkbox" class="category_sub_title">@lang('Both')</label>
                    </li>
                </ul>
            @endif
        </li>
        <li>
            <div class="category_wrapper">
                <div class="your_choices_category_title">
                    @lang('Age')
                </div>
                <div class="count_and_more">
                    <span class="choices_count {{ $order->age && ($order->age['from'] || $order->age['to']) ? '' : 'null_counts' }}">{{ $order->age && ($order->age['from'] || $order->age['to']) ? count($order->age) : 0 }}</span>
                    <span class="expander"> <i class="fas fa-angle-down"></i> </span>
                </div>
            </div>
            @if($order->age  && ($order->age['from'] || $order->age['to']))
                <ul class="your_choices_sublist">
                    <div class="date_pick">
                        <div class="input-daterange input-group">
                            <span class="input-group-addon">@lang('From')</span>
                            <input data-tab="age" type="number" class="input-sm form-control selected" name="selected[age][from]" value="{{ $order->age['from'] }}"/>
                            <span class="input-group-addon">@lang('To')</span>
                            <input data-tab="age" type="number" class="input-sm form-control selected" name="selected[age][to]" value="{{ $order->age['to'] }}"/>
                        </div>
                    </div>
                </ul>
            @endif
        </li>
        <li>
            <div class="category_wrapper">
                <div class="your_choices_category_title">
                    @lang('Geography')
                </div>
                <div class="count_and_more">
                    <span class="choices_count {{ $order->geography ? '' : 'null_counts' }}">{{ $order->geography ? count($order->geography) : 0 }}</span>
                    <span class="expander"> <i class="fas fa-angle-down"></i> </span>
                </div>
            </div>
            <ul class="tab_list your_choices_sublist">
                @if(isset($order->geography['county']))
                    <li class="tab_list_item">
                        <input data-tab="geography" class="styled-checkbox selected" type="checkbox" name="selected[geography][county]" value="1" {{ isset($order->geography['county']) ? 'checked' : '' }}>
                        <label for="styled-checkbox" class="category_sub_title">
                            <span> <i class="fas fa-angle-down"></i>@lang('County, Municipality')</span>
                        </label>

                        <ul class="tab_sublist">
                            @if(is_array($order->geography['county']))
                                @foreach($order->geography['county'] as $key => $val)
                                    <li class="tab_sublist_item">
                                        <input data-tab="geography" class="styled-checkbox selected" type="checkbox" name="selected[geography][county][{{ $key }}]" value="1" {{ isset($order->geography['county'][$key]) ? 'checked' : '' }}>
                                        <label for="styled-checkbox" class="category_sub_title">
                                            <span> <i class="fas fa-angle-down"></i>{{ $key }}</span>
                                        </label>
                                        <ul class="tab_sublist">
                                            @if(is_array($val))
                                                @foreach($val as $area => $val)
                                                    <li class="tab_sublist_item">
                                                        <input data-tab="geography" class="styled-checkbox selected" type="checkbox" name="selected[geography][county][{{ $key }}][{{ $area }}]" value="1" {{ isset($order->geography['county'][$key][$area]) ? 'checked' : '' }}>
                                                        <label for="styled-checkbox" class="category_sub_title">
                                                            <span> {{ $area }}</span>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </li>
                                @endforeach
                            @endif                              
                        </ul>
                    </li>
                @endif
                @if(isset($order->geography['zip']))
                    <li class="tab_list_item">
                        <input data-tab="geography" class="styled-checkbox selected" type="checkbox" name="selected[geography][zip]" value="1" {{ isset($order->geography['zip']) ? 'checked' : '' }}>
                        <label for="styled-checkbox" class="category_sub_title">
                            <span> <i class="fas fa-angle-down"></i>@lang('Zip code')</span>
                        </label>
                        <ul class="tab_sublist">
                            @if(is_array($order->geography['zip']))
                                @foreach($order->geography['zip'] as $key => $val)
                                    <li class="tab_sublist_item">
                                        <input data-tab="geography" class="styled-checkbox selected" type="checkbox" name="selected[geography][zip][{{ $key }}]" value="{{ $val }}" checked>
                                        <label for="styled-checkbox" class="category_sub_title">
                                            <span> <i class="fas fa-angle-down fa"></i>{{ $val }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                @endif
            </ul>
        </li>
        <li>
            <div class="category_wrapper">
                <div class="your_choices_category_title">
                    @lang('Living Type')
                </div>
                <div class="count_and_more">
                    <span class="choices_count {{ $order->living_type ? '' : 'null_counts' }}">{{ $order->living_type ? count($order->living_type) : 0 }}</span>
                    <span class="expander"> <i class="fas fa-angle-down"></i> </span>
                </div>
            </div>
            @if($order->living_type)
                <ul class="your_choices_sublist">
                    @foreach(\App\Order::$livings as $key => $val)
                        <li>
                            <input data-tab="living" name="selected[living_type][{{ $key }}]" class="styled-checkbox selected" type="checkbox" value="1" {{ isset($order->living_type[$key]) ? 'checked' : '' }}>
                            <label for="styled-checkbox" class="category_sub_title">@lang($val)</label>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
        <li>
            <div class="category_wrapper">
                <div class="your_choices_category_title">
                    @lang('Phone Numbers')
                </div>
                <div class="count_and_more">
                    <span class="choices_count {{ $order->phone_numbers ? '' : 'null_counts' }}">{{ $order->phone_numbers ? 1 : 0 }}</span>
                    <span class="expander"> <i class="fas fa-angle-down"></i> </span>
                </div>
            </div>
            @if($order->phone_numbers)
                <ul class="your_choices_sublist">
                    @foreach(\App\Order::$phone_numbers as $key => $val)
                        <li>
                            <input data-tab="phone" name="selected[phone_numbers]" class="styled-checkbox selected" type="radio" value="{{ $key }}" {{ $order->phone_numbers == $key ? 'checked' : '' }}>
                            <label for="styled-checkbox" class="category_sub_title">{{ __($val) }}</label>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
        <li>
            <div class="category_wrapper">
                <div class="your_choices_category_title">
                    @lang('Exclude your own data')
                </div>
                <div class="count_and_more">
                    <span class="choices_count {{ $order->exclude ? '' : 'null_counts' }}">{{ $order->exclude ? count($order->exclude) : 0 }}</span>
                    <span class="expander"> <i class="fas fa-angle-down"></i> </span>
                </div>
            </div>
            @if($order->exclude)
                <ul class="your_choices_sublist">
                    <li>
                        <input data-tab="exclude" class="styled-checkbox selected" type="checkbox" name="selected[excluding]" value="1" checked>
                        <label for="styled-checkbox" class="category_sub_title">{{ __('Exclude :number phone numbers', ['number' => count($order->exclude)]) }}</label>
                    </li>
                </ul>
            @endif
        </li>
    </ul>

    <div class="match_records">

        <div class="list_icon">
            <i class="fas fa-list"></i>
        </div>

        <div class="records_count">
            {{ number_format($order->matching_records) }}
        </div>

        <div class="records_text">
            @lang('matching <br> records')
        </div>
    </div>

    <button class="upd_btn upd_records" type="submit">
        <span class="upd_btn_text">@lang('Update records')</span>
        <div class="upd_btn_loader">
            <div class="loader"></div>
            <span class="updating">@lang('Updating')</span>
        </div>
    </button>
</div>

