<ul class="nav nav-tabs selected_form">
    <li class="">
        <a href="#sex_choice" data-toggle="tab" class="active">
            @lang('Gender') ({{ $order->gender != null ? 1 : 0 }})
        </a>
    </li>
    <li>
        <a href="#age_choice" data-toggle="tab">
            @lang('Age')({{ $order->age && ($order->age['from'] || $order->age['to']) ? count($order->age) : 0 }})
        </a>
    </li>
    <li>
        <a href="#geography_choice" data-toggle="tab">
            @lang('Geography')({{ $order->geography ? count($order->geography) : 0 }})
        </a>
    </li>
    <li>
        <a href="#form_accomondation_choice" data-toggle="tab">
            @lang('Living type')({{ $order->living_type ? count($order->living_type) : 0 }})
        </a>
    </li>
    <li>
        <a href="#phone_number_choice" data-toggle="tab">
            @lang('Phone numbers')({{ $order->phone_numbers ? 1 : 0 }})
        </a>
    </li>
    <li>
        <a href="#exclude_data_choice" data-toggle="tab">
            @lang('Exclude your own data')({{ $order->exclude ? count($order->exclude) : 0 }})
        </a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="sex_choice">
        <div class="form-group clearfix">
            <div class="col-md-8 text-center m-auto">
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    @if ($order->gender != null)
                        <label class="btn blue {{ $order->gender == 'M' ? 'active' : '' }}">
                            <input data-tab="gender" aria-hidden="true" name="selected[gender]"
                                class="styled-checkbox selected toggle" type="radio" value="M"
                                {{ $order->gender == 'M' ? 'checked' : '' }}><i class="fa fa-male"
                                aria-hidden="true"></i> @lang('Man')
                        </label>
                        <label class="btn blue {{ $order->gender == 'K' ? 'active' : '' }}">
                            <input data-tab="gender" aria-hidden="true" name="selected[gender]"
                                class="styled-checkbox selected toggle" type="radio" value="K"
                                {{ $order->gender == 'K' ? 'checked' : '' }}><i class="fa fa-female"
                                aria-hidden="true"></i> @lang('Woman')
                        </label>
                        <label class="btn blue {{ $order->gender == '0' ? 'active' : '' }}">
                            <input data-tab="gender" aria-hidden="true" name="selected[gender]"
                                class="styled-checkbox selected toggle" type="radio" value="0"
                                {{ $order->gender == '0' ? 'checked' : '' }}><i class="fa fa-users"
                                aria-hidden="true"></i> @lang('Both')
                        </label>
                    @else
                        <div class="note note-info">
                            <h4>@lang('Please choose gender here')</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="age_choice">
        @if ($order->age && ($order->age['from'] || $order->age['to']))
            <div class="form-group last">
                <label class="control-label col-md-1 para-color text-left">@lang('From'):</label>
                <div class="col-md-8">
                    <div id="spinner4">
                        <div class="input-group">
                            <div class="spinner-buttons input-group-btn">
                                <button type="button" class="btn spinner-up blue">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <input data-tab="age" type="number"
                                class="input-md form-control selected spinner-input form-control"
                                name="selected[age][from]" value="{{ $order->age['from'] }}" />
                            <div class="spinner-buttons input-group-btn">
                                <button type="button" class="btn spinner-down red">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="form-group last">
                <label class="control-label col-md-1 para-color text-left">@lang('To'):</label>
                <div class="col-md-8">
                    <div id="spinner3">
                        <div class="input-group">
                            <div class="spinner-buttons input-group-btn">
                                <button type="button" class="btn spinner-up blue">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <input data-tab="age" type="number"
                                class="input-md form-control selected spinner-input form-control"
                                name="selected[age][to]" value="{{ $order->age['to'] }}" />
                            <div class="spinner-buttons input-group-btn">
                                <button type="button" class="btn spinner-down red">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        @else
            <div class="note note-info">
                <h4>@lang('Please choose age arrange here')</h4>
            </div>
        @endif
    </div>

    <div class="tab-pane" id="geography_choice">
        <div class="form-group">
            <div class="col-lg-12 col-md-12 col-sm-12 geography-tab">
                <div class="tab_list_wrapper selected_tab_wrapper">
                    @if (isset($order->geography['county']) || isset($order->geography['zip']))
                        <ul class="tab_list your_choices_sublist">
                            @if (isset($order->geography['county']))
                                <li class="tab_list_item">
                                    <input data-tab="geography" class="styled-checkbox selected" type="checkbox"
                                        name="selected[geography][county]" value="1"
                                        {{ isset($order->geography['county']) ? 'checked' : '' }}>
                                    <label for="styled-checkbox" class="category_sub_title">
                                        <span> <i class="fas fa fa-angle-down"></i>@lang('County, Municipality')</span>
                                    </label>
                                    <ul class="tab_sublist">
                                        @if (is_array($order->geography['county']))
                                            @foreach ($order->geography['county'] as $key => $val)
                                                <li class="tab_sublist_item">
                                                    <input data-tab="geography" class="styled-checkbox selected"
                                                        type="checkbox"
                                                        name="selected[geography][county][{{ $key }}]"
                                                        value="1"
                                                        {{ isset($order->geography['county'][$key]) ? 'checked' : '' }}>
                                                    <label for="styled-checkbox" class="category_sub_title">
                                                        <span> <i
                                                                class="fas fa fa-angle-down"></i>{{ $key }}</span>
                                                    </label>
                                                    <ul class="tab_sublist">
                                                        @if (is_array($val))
                                                            @foreach ($val as $area => $val)
                                                                <li class="tab_sublist_item">
                                                                    <input data-tab="geography"
                                                                        class="styled-checkbox selected"
                                                                        type="checkbox"
                                                                        name="selected[geography][county][{{ $key }}][{{ $area }}]"
                                                                        value="1"
                                                                        {{ isset($order->geography['county'][$key][$area]) ? 'checked' : '' }}>
                                                                    <label for="styled-checkbox"
                                                                        class="category_sub_title">
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
                            @if (isset($order->geography['zip']))
                                <li class="tab_list_item">
                                    <input data-tab="geography" class="styled-checkbox selected" type="checkbox"
                                        name="selected[geography][zip]" value="1"
                                        {{ isset($order->geography['zip']) ? 'checked' : '' }}>
                                    <label for="styled-checkbox" class="category_sub_title">
                                        <span> <i class="fas fa fa-angle-down"></i>@lang('Zip code')</span>
                                    </label>
                                    <ul class="tab_sublist">
                                        @if (is_array($order->geography['zip']))
                                            @foreach ($order->geography['zip'] as $key => $val)
                                                <li class="tab_sublist_item">
                                                    <input data-tab="geography" class="styled-checkbox selected"
                                                        type="checkbox"
                                                        name="selected[geography][zip][{{ $key }}]"
                                                        value="{{ $val }}" checked>
                                                    <label for="styled-checkbox" class="category_sub_title">
                                                        <span> <i
                                                                class="fas fa fa-angle-down"></i>{{ $val }}</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    @else
                        <div class="note note-info">
                            <h4>@lang('Please choose live type here')</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="form_accomondation_choice">
        @if ($order->living_type)
            @foreach (\App\Order::$livings as $key => $val)
                <div class="form-group last">
                    <div class="col-md-12">
                        <div class="md-checkbox para-color">
                            <input data-tab="living" name="selected[living_type][{{ $key }}]"
                                class="styled-checkbox selected md-check" type="checkbox" value="1"
                                id="checkbox3{{ $key }}"
                                {{ isset($order->living_type[$key]) ? 'checked' : '' }}>
                            <label for="checkbox3{{ $key }}">
                                @lang($val):
                            </label>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="note note-info">
                <h4>@lang('Please choose accomondation here')</h4>
            </div>
        @endif
    </div>

    <div class="tab-pane" id="phone_number_choice">
        <div class="form-group">
            <div class="col-md-12">
                <div class="md-radio-list">
                    @if ($order->phone_numbers)
                        @foreach (\App\Order::$phone_numbers as $key => $val)
                            <div class="md-radio para-color">
                                <input data-tab="phone" name="selected[phone_numbers]"
                                    class="styled-checkbox selected md-radiobtn" type="radio"
                                    value="{{ $key }}" id="radio$key"
                                    {{ $order->phone_numbers == $key ? 'checked' : '' }}>
                                <label for="radio9">
                                    {{ __($val) }}
                                </label>
                            </div>
                        @endforeach
                    @else
                        <div class="note note-info">
                            <h4>@lang('Please choose phone number here')</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="exclude_data_choice">
        @if ($order->exclude)
            <div class="note note-info">
                <h4>{{ __('Exclude :number phone numbers', ['number' => count($order->exclude)]) }}</h4>
            </div>
        @else
            <div class="note note-info">
                <h4>@lang('Please import data to exclude')</h4>
            </div>
        @endif
    </div>
</div>
