@extends('layouts.app')
@section('stylesheets')
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
<link type="text/css" href="/css/font-awesome.css" rel="stylesheet" media="all">
<link type="text/css" href="/css/bootstrap.min.css" rel="stylesheet" media="all">
<link type="text/css" href="/css/jstree/style.min.css" rel="stylesheet" media="all">
<link type="text/css" href="/css/components-rounded.css" rel="stylesheet" media="all">
<link type="text/css" href="/css/plugins.css" rel="stylesheet" media="all">
<link type="text/css" href="/css/layout.css" rel="stylesheet" media="all">

<link type="text/css" href="/css/custom.css" rel="stylesheet" media="all">
@endsection
@section('content')
    <div class="row">                
        <div class="col-md-6">
            <!-- BEGIN PAGE CONTENT-->
            <div class="portlet sale-primary-color box">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-credit-card"></i> @lang('Purchaser Information')
                    </div>
                    <div class="tools hidden-xs">
                        <a href="javascript:;" class="collapse">
                        </a>											                      
                    </div>
                </div>
                <div class="portlet-body form">
                    @if ($errors->any())                        
                        <div class="note note-danger">         
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>                                           
                        </div>
                    @endif
                    <form role="form" action="/orders/confirm" method="POST" class="order_confirm_form">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="first_name" name = "first_name" placeholder="@lang('First name')" value="{{ $order->first_name }}">                                        
                                        <span class="help-block">Please input the first name.</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="last_name" name = "last_name"  placeholder="@lang('Last name')" value="{{ $order->last_name }}">                                        
                                        <span class="help-block">Please input the last name.</span>
                                    </div>
                                </div>
                            </div>         
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <input type="email" class="form-control" id="email"  name = "email" placeholder="@lang('Email')" value="{{ $order->email }}">                                        
                                        <span class="help-block">Please input the email.</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="postal_address" name = "postal_address" placeholder="@lang('Postal address')" value="{{ $order->postal_address }}">                                        
                                        <span class="help-block">Please input the post address.</span>
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="zip" name = "zip" placeholder="@lang('ZIP')" value="{{ $order->zip }}">                                        
                                        <span class="help-block">Please input zip.</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="area" name = "area" placeholder="@lang('Area')" value="{{ $order->area }}">                                        
                                        <span class="help-block">Please input the area.</span>
                                    </div>
                                </div>                                  
                            </div> 
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="organization_number" name = "organization_number" placeholder="@lang('Organization number')" value="{{ $order->organization_number }}">                                        
                                        <span class="help-block">Please input the organization number.</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="company_name" name = "company_name" placeholder="@lang('Company name')" value="{{ $order->company_name }}">                                        
                                        <span class="help-block">Please input the company name.</span>
                                    </div>
                                </div>                                
                            </div> 
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="message" name = "message" placeholder="@lang('Message (not mandatory)')" value="{{ $order->message }}">                                        
                                        <span class="help-block">Please input the message</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="phone" name = "phone" placeholder="@lang('Phone')" value="{{ $order->phone }}">                                        
                                        <span class="help-block">Please input the phone number.</span>
                                    </div>
                                </div>                                
                            </div> 
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input has-info">
                                        <?php                                         
                                        ?>
                                        <select class="form-control" id="payment_option" name="payment_option">
                                            <option>@lang('Choose')</option>
                                            @if(setting('invoice_available', 0) == 1)                              
                                                <!-- <option value="invoice" {{ $order->payment_option == 'invoice' ? 'selected' : '' }}>@lang('Invoice') </option> -->
                                            @endif
                                            {{--<option value="payson" {{ $order->payment_option == 'payson' ? 'selected' : '' }}>@lang('Payson')</option>--}}
                                            <option value="invoice" {{ $order->payment_option == 'invoice' ? 'selected' : '' }}>@lang('Invoice') </option>
                                            <option value="stripe" {{ $order->payment_option == 'stripe' ? 'selected' : '' }}>Stripe</option>
                                            <!-- <option value="billmate" {{ $order->payment_option == 'billmate' ? 'selected' : '' }}>@lang('Kortbetalning')</option> -->
                                        </select>                                        
                                    </div>  
                                </div>
                            </div>   
                            <div class="row">
                                <div class="col-md-6">                                    
                                    <div class="md-checkbox">
                                        <input type="checkbox" id="terms" class="md-check">
                                        <label for="terms" class="icon-state-warning">
                                        <span class="inc"></span>
                                        <span class="check"></span>
                                        <span class="box"></span>
                                            @lang('I accept the Terms and Conditions')
                                        </label>
                                    </div>
                                </div>                               
                            </div>                                                                         
                        </div>
                        <div class="form-actions noborder">
                            <button type="submit" class="btn sale-primary-color">Submit</button>                            
                        </div>
                    </form>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
        <div class="col-md-6">
            @include('orders.partials.selectedConfirm')   
        </div>
    </div>  				   
@endsection
@section('scripts')       
@endsection
