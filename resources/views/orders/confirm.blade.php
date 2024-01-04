@extends('layouts.test')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="your_selection">
                <div class="your_selection_title">
                    <span>
                        @lang('Your selection')
                    </span>
                    <a href="/">@lang('Edit selection')</a>
                </div>
                <div class="your_selection_list">
                    <ul>
                        @if($order->gender)
                            <li>
                                <p>@lang('Gender')</p>
                                <span>{{ $order->gender }}</span>
                            </li>
                        @endif
                        @if($order->age)
                            <li>
                                <p>@lang('Age')</p>
                                @foreach($order->age as $key => $val)
                                    <span>{{ __($key) }} {{ __($val) }}</span>
                                @endforeach
                            </li>
                        @endif
                        @if($order->geography)
                            <li>
                                <p>@lang('Geography')</p>
                                @if(isset($order->geography['county']))
                                    <span>@lang('County')</span>
                                    @foreach($order->geography['county'] as $key => $val)
                                        <span>{{ $key }}({{ count($val) }})</span>
                                    @endforeach
                                @endif
                                @if(isset($order->geography['zip']))
                                    <br>
                                    <span>@lang('Zip code')</span>
                                    @foreach($order->geography['zip'] as $key => $val)
                                        <span>{{ $val }}</span>
                                    @endforeach
                                @endif
                            </li>
                        @endif
                        @if($order->living_type)
                                <li>
                                    <p>@lang('Living Type')</p>
                                    @foreach($order->living_type as $key => $val)
                                        <span>{{ __($key) }}</span>
                                    @endforeach
                                </li>
                        @endif
                        @if($order->phone_numbers)
                            <li>
                                <p>@lang('Phone number')</p>
                                    <span>{{ __(\App\Order::$phone_numbers[$order->phone_numbers]) }}</span>
                            </li>
                        @endif
                        @if($order->exclude)
                            <li>
                                <p>@lang('Exclude phone/mobile phone numbers from file')</p>
                                <span>{{ count($order->exclude) }} @lang('phone numbers')</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <form action="/orders/confirm" method="POST">
        @csrf
        <div class="row purchaser_information_wrapper m-0">
            <div class="col-lg-8 col-md-12">
                <div class="purchaser_information">
                    <h2>@lang('Purchaser Information')</h2>
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <label for=""> @lang('First name')
                                <input type="text" name="first_name" value="{{ $order->first_name }}">
                            </label>
                            <label for=""> @lang('Last name')
                                <input type="text" name="last_name" value="{{ $order->last_name }}">
                            </label>
                            <label for=""> @lang('Email')
                                <input type="email" name="email" value="{{ $order->email }}">
                            </label>
                            <label for=""> @lang('Postal address')
                                <input type="text" name="postal_address" value="{{ $order->postal_address }}">
                            </label>
                            <label for=""> @lang('ZIP')
                                <input type="text" name="zip" value="{{ $order->zip }}">
                            </label>
                            <label for=""> @lang('Area')
                                <input type="text" name="area" value="{{ $order->area }}">
                            </label>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <label for=""> @lang('Company name')
                                <input type="text" name="company_name" value="{{ $order->company_name }}">
                            </label>
                            <label for=""> @lang('Organization number')
                                <input type="text" name="organization_number" value="{{ $order->organization_number }}">
                            </label>
                            <label for=""> @lang('Phone')
                                <input type="text" name="phone" value="{{ $order->phone }}">
                            </label>
                            <label for=""> @lang('Message (not mandatory)')
                                <input type="text" name="message" value="{{ $order->message }}">
                            </label>
                            <label for=""> @lang('Choose payment option')
                                <select name="payment_option" id="payment_option" required>
                                    <option>@lang('Choose')</option>
                                    <!-- @if(setting('invoice_available', 0) == 1)
                                        <option value="invoice" {{ $order->payment_option == 'invoice' ? 'selected' : '' }}>@lang('Invoice') </option>
                                    @endif -->
                                    <option value="invoice" {{ $order->payment_option == 'invoice' ? 'selected' : '' }}>@lang('Invoice') </option>
                                    {{--<option value="payson" {{ $order->payment_option == 'payson' ? 'selected' : '' }}>@lang('Payson')</option>--}}
                                    <option value="billmate" {{ $order->payment_option == 'billmate' ? 'selected' : '' }}>@lang('Kortbetalning')</option>
                                </select>
                            </label>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <!-- {!! app('captcha')->display() !!} -->
                            <div class="wrapper">
                                <input class="styled-checkbox" type="checkbox" name="terms" required>
                                <label for="styled-checkbox " class="category_sub_title terms_accept">
                                    <a href="/terms" target="_blank" class="terms">@lang('I accept the Terms and Conditions')</a>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 d-flex flex-column justify-content-between ">
                <div class="compilation_wrapper">
                    <h2>
                        @lang('Compilation of orders')
                    </h2>

                    <div class="total_compilation">
                        <div class="total_compilation__item">
                            <span class="item_title">
                                @lang('Total matching items')
                            </span>
                            <span class="item_value">
                                {{ number_format($order->matching_records) }}
                            </span>
                        </div>

                        <div class="total_compilation__item">
                            <span class="item_title">
                                @lang('Address register acc. to order')
                            </span>
                            <span class="item_value">
                                {{ number_format($order->number_to_purchase) }}
                            </span>
                        </div>
                        <div class="total_compilation__item">
                            <span class="item_title">
                                @lang('Price')
                            </span>
                            <span class="item_value">
                                {{ number_format($order->price, 2) }} kr
                            </span>
                        </div>
                        <div class="total_compilation__item">
                            <span class="item_title">
                                @lang('Admin Fee')
                            </span>
                            <span class="item_value">
                                {{ number_format(setting('admin_fee', 0), 2) }} kr
                            </span>
                        </div>
                        <div class="total_compilation__item">
                            <span class="item_title">
                                @lang('VAT')
                            </span>
                            <span class="item_value">
                                {{ number_format($order->vat, 2) }} kr
                            </span>
                        </div>

                        <div class="total_compilation__item">
                            <span class="item_title">
                                @lang('Contract reduction')
                            </span>
                            <span class="item_value">
                                {{ number_format($order->discount_percent, 2) }}%
                            </span>
                        </div>
                        <div class="total_to_pay">
                            @lang('Total to pay')
                            <p>
                                SEK {{ number_format($order->total_to_pay, 2) }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="buttons_wrapper">
                    <a href="/" class="next_btn upd_btn"><i class="fas fa-arrow-left"></i> @lang('Back') </a>
                    <button type="submit" class="next_btn upd_btn ">@lang('Next') <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </form>

@endsection
