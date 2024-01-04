@extends('layouts.app')
@section('stylesheets')
    <link type="text/css" href="/css/custom.css" rel="stylesheet" media="all">
@endsection
@section('content')
    <div class="row" style="background-color: white;">
        <div class="col-12">           
            <div class="upsell_info_wrapper">
                @if (isset($errors) && $errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                @if (Session::has('flash_message'))
                    <div class="container">
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ Session::get('flash_message') }}
                        </div>
                    </div>
                @endif
                @if((isset($order) || $order = session('order')) && !$order->nix_validation)
                    <div class="col-md-10 col-md-offset-1">
                        <div class="note note-info">
                            <h2>
                                @lang('Thank!')
                            </h2>
                            <h3>
                                @lang('Remember that if you have ordered phone numbers you need to check the numbers against the NIX register.')
                            </h3>
                            <p>
                                @lang('Since the NIX register is constantly updated BizWell can\'t offer NIX\'ed numbers, instead all numbers must be checked against the NIX-register upon purchase. You can either do this yourself by creating an account at nixtelefon.org or have us do it for you!')
                            </p>

                            <span class="cost_info">
                                @lang('The cost to run your purchased list against the NIX-register is accordingly'):
                            </span>
                        </div>
                    </div>
                    
                    <div class="col-md-8 col-md-offset-2">
                        <h4>
                            @lang('Click the "ORDER NOW" button below to order the NIX-service online and we will have your file ready in no time.')
                        </h4>
                        <div class="portlet green-meadow box">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-cogs"></i>Billing Address
                                </div>
                                <div class="actions">
                                    <a href="/orders/{{ $order->id }}/nix-validation" class="btn btn-default btn-sm">
                                    <i class="fa fa-arrow"></i> @lang('Order now') </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row static-info">
                                    <div class="col-md-12 value">
                                        {{ number_format($order->number_to_purchase) }} @lang('no\'s')<br>
                                        {{ number_format($order->number_to_purchase * setting('nix_validation_price', 0.25), 2) }} kr<br>
                                        @lang('admin fee')<br>
                                        {{ setting('nix_validation_admin_fee', 800) }} kr<br>
                                        @lang('TOTAL')<br>
                                        {{ number_format($order->nixValidationPrice, 2) }} kr<br>
                                        <span>i</span> @lang('VAT will be added with') {{ setting('vat_percent', 25) }}%<br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                                   
                @else
                    <div class="note note-info mb-0">
                        <h2>
                            @lang('Thank!')
                        </h2>
                        <h3 class="mb-0">
                            @lang('We\'ll get back to you as soon as possible with your order.')
                        </h3>
                    </div>                    
                @endif
            </div>
        </div>
    </div>
@endsection
