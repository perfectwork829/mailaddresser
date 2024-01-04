<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet sale-primary-color box">
            <div class="portlet-title para-color">
                <div class="caption">
                    <i class="fa fa-cogs"></i>@lang('Your selection')
                </div>
                <div class="actions">
                    <a href="{{route('home')}}" class="btn btn-custom-default btn-sm">
                    <i class="fa fa-pencil"></i> Change selection </a>
                </div>
            </div>
            <div class="portlet-body para-color">
                @if(isset($order->gender))
                    <div class="row static-info">
                        <div class="col-md-5 name">
                            @lang('Gender'):
                        </div>
                        <div class="col-md-7 value">                            
                            <span  class="label label-success">
                                {{ $order->gender }}
                            </span>
                        </div>
                    </div>
                @endif
                @if(isset($order->age))
                    <div class="row static-info">
                        <div class="col-md-5 name">
                            @lang('Age'):
                        </div>
                        <div class="col-md-7 value">                            
                            @foreach($order->age as $key => $val)
                                <span class="label label-success">{{ __($key) }} {{ __($val) }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if(isset($order->geography))
                    <div class="row static-info">
                        <div class="col-md-5 name">
                            @lang('Geography'):
                        </div>
                        <div class="col-md-7 value">                                                        
                            @if(isset($order->geography['county']))
                                <span class="label label-success">@lang('County')</span>
                                @foreach($order->geography['county'] as $key => $val)          
                                    @if(is_array($val))                      
                                        <span class="label label-info">{{ $key }}({{ count($val) }})</span>
                                    @else
                                        <span class="label label-info">{{ $key }}</span>
                                    @endif
                                @endforeach
                            @endif
                            @if(isset($order->geography['zip']))
                                <br>
                                <span class="label label-success">@lang('Zip code')</span>
                                @foreach($order->geography['zip'] as $key => $val)
                                    <span class="label label-info">{{ $val }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endif
                @if(isset($order->living_type))                
                    <div class="row static-info">
                        <div class="col-md-5 name">
                            @lang('Living Type'):
                        </div>
                        <div class="col-md-7 value">                        
                            @foreach($order->living_type as $key => $val)
                                <span class="label label-success">{{ __($key) }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif                
                @if(isset($order->phone_numbers))
                    <div class="row static-info">
                        <div class="col-md-5 name">
                            @lang('Phone number'):
                        </div>
                        <div class="col-md-7 value">                            
                            <span  class="label label-success">
                                {{ __(\App\Order::$phone_numbers[$order->phone_numbers]) }}
                            </span>
                        </div>
                    </div>
                @endif
                @if(isset($order->exclude))
                    <div class="row static-info">
                        <div class="col-md-5 name">
                            @lang('Exclude phone/mobile phone numbers from file')
                        </div>
                        <div class="col-md-7 value">                                                        
                            <span class="label label-success">{{ count($order->exclude) }} @lang('phone numbers')</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="portlet sale-primary-color box">
            <div class="portlet-title para-color">
                <div class="caption">
                    <i class="fa fa-cogs"></i>@lang('Compilation of orders')
                </div>                
            </div>
            <div class="portlet-body para-color">
                <div class="row static-info">
                    <div class="col-md-5 name">
                        @lang('Total matching items'):
                    </div>
                    <div class="col-md-7 value">
                        {{ number_format($order->matching_records) }}
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-5 name">
                        @lang('Address register acc. to order'):
                    </div>
                    <div class="col-md-7 value">
                        {{ number_format($order->number_to_purchase) }}
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-5 name">
                        @lang('Price'):
                    </div>
                    <div class="col-md-7 value">
                        {{ number_format($order->price, 2) }} kr
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-5 name">
                        @lang('Admin Fee'):
                    </div>
                    <div class="col-md-7 value">
                        {{ number_format(setting('admin_fee', 0), 2) }} kr
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-5 name">
                        @lang('VAT'):
                    </div>
                    <div class="col-md-7 value">
                        {{ number_format($order->vat, 2) }} kr
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-5 name">
                        @lang('Contract reduction'):
                    </div>
                    <div class="col-md-7 value">
                        {{ number_format($order->discount_percent, 2) }}%
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-5 name">
                        @lang('Total to pay')
                    </div>
                    <div class="col-md-7 value">
                        SEK {{ number_format($order->total_to_pay, 2) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>