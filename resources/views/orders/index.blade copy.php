@extends('layouts.app')
@section('stylesheets')
<!-- <link type="text/css" href="/css/main.css" rel="stylesheet" media="all"> -->
<link type="text/css" href="/css/custom.css" rel="stylesheet" media="all">
@endsection
@section('content')
    <div class="row">                  
        <form role="form" class="form-horizontal filter-form search_form" id="submit_form" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12 ">
                <!-- BEGIN PAGE CONTENT-->
                <div class="portlet box sale-primary-color mailaddress_container" id="form_wizard_1">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-credit-card"></i> Adresser till privatpersoner
                        </div>                                                
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-12">
                                @if ($errors->any())
                                    <div class="note note-info">                        
                                        <ul class="">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>                                    
                                @endif 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7"> 
                                <ul class="nav nav-tabs choose_from_address">
                                    <li>
                                        <a href="#gender" data-toggle="tab" class="step active">                                
                                        <span class="desc">@lang('Gender') </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#age" data-toggle="tab" class="step">                                
                                            <span class="desc">@lang('Age') </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#geography" data-toggle="tab" class="step">                                
                                            <span class="desc">@lang('Geography') </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#living_type" data-toggle="tab" class="step">                                
                                            <span class="desc">@lang('Living Type') </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#phone_numbers" data-toggle="tab" class="step">                                
                                            <span class="desc">@lang('Phone Numbers')</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#exclude_your_own_data" data-toggle="tab" class="step">                                
                                            <span class="desc">@lang('Exclude your own data') </span>
                                        </a>
                                    </li>
                                </ul>                                
                                <div class="tab-content mailaddress_tab_content">
                                    <div class="alert alert-danger display-none">
                                        <button class="close" data-dismiss="alert"></button>
                                        You have some form errors. Please check below.
                                    </div>
                                    <div class="alert alert-success display-none">
                                        <button class="close" data-dismiss="alert"></button>
                                        Your form validation is successful!
                                    </div>
                                    <div class="tab-pane active" id="gender" >															
                                        @include('orders.partials.gender-tab')
                                    </div>
                                    <div class="tab-pane" id="age">															
                                        @include('orders.partials.age-tab')				
                                    </div>
                                    <div class="tab-pane" id="geography" role="tabpanel" aria-labelledby="geography-tab">
                                        @include('orders.partials.geography-tab')
                                    </div>
                                    <div class="tab-pane" id="living_type">
                                        @include('orders.partials.living-tab')
                                    </div>
                                    <div class="tab-pane" id="phone_numbers">
                                        @include('orders.partials.phone-tab')
                                    </div>
                                    <div class="tab-pane" id="exclude_your_own_data">
                                        @include('orders.partials.exclude-tab')																													
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <h3 class="sale-primary-forcolor">@lang('Your Choices')</h3>
                                <div class="your_choices_wrapper">
                                    @include('orders.partials.selected')  
                                </div> 
                            </div>	
                        </div>                        
                    </div>  
                    <div class="portlet-footer">
                        <div class="row">
                            <div class="col-md-12 upd_btn_count">
                                <button class="upd_records btn upd_btn sale-primary-color " type="submit">
                                    <span class="upd_btn_text">@lang('Update records')</span>                                    
                                </button>
                                <div class="icon-state-warning">
                                    <h3 class="records_count">{{ number_format($order->matching_records) }}</h3>
                                </div>
                                <div class="records_text icon-state-warning">
                                    @lang('matching records')
                                </div>
                            </div>
                        </div>                        
                    </div>                 
                </div>
                <!-- END PAGE CONTENT-->
            </div>            
        </form>				
    </div>
    <div class="row" id="setting_price_section">
        <div class="col-md-12">
            <div class="portlet box sale-primary-color setting_price">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-money"></i> @lang('Setting Price')
                    </div>                    
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form role="form" class="form-horizontal upd_form" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="form-group">											
                                        <div class="col-md-6 para-color">
                                            <div class="input-icon right">													
                                                <span class="help-block">@lang('Enter the desired number to purchase')</span>
                                                <i class="fa fa-info-circle tooltips" data-original-title="Email address" data-container="body"></i>
                                                <input type="number" class="form-control" name="number_to_purchase"  min="1" required value="{{ $order->number_to_purchase ? $order->number_to_purchase : $order->matching_records }}"/>                                            
                                            </div>
                                        </div>		
                                        <div class="col-md-6 para-color">
                                            <div class="input-icon right">													
                                                <span class="help-block">@lang('Discount code')</span>
                                                <i class="fa fa-info-circle tooltips" data-original-title="Email address" data-container="body"></i>
                                                <input type="text" class="form-control" name="discount_code" value="{{ $order->discount_code }}"/>                                            
                                            </div>
                                        </div>									
                                        <div class="col-md-12">
                                            <button type="submit" class="btn sale-primary-color mt-90">@lang('Update price') <i class="m-icon-swapright m-icon-white"></i></button>
                                        </div>
                                    </div>
                                </div>                            
                            </form>
                        </div>
                        <div class="col-md-6 counters">
                            @include('orders.partials.counters')
                        </div>
                    </div>                    
                </div>
            </div>
        </div>		        	
    </div>		
    
    <div class="row">
        <div class="col-md-12 text-right">
            <button type="button" class="next_btn btn confirm-button sale-primary-color">@lang('Next') <i class="m-icon-swapright m-icon-white"></i></button>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="/js/bootstrap.min.js"></script>    
    <script src="/js/spinner.min.js"></script>
    <script src="/js/jquery.validate.min.js"></script>
    <script src="/js/jquery.bootstrap.wizard.min.js"></script>    
    {{-- <script src="/js/select2.min.js"></script>
    <script src="/js/jstree.min.js"></script>
    <script src="/js/ui-tree.js"></script> --}}
    <script src="/js/metronic.js"></script>    
    {{-- <script src="/js/form-wizard.js"></script> --}}
    <script src="/js/jquery.blockui.min.js"></script>
    <script src="/js/components-form-tools.js"></script>    
    <script src="/js/layout.js"></script>    
    <!-- <script src="/js/main.js"></script>-->
    <script>
        $(document).ready(function() {                      
            Metronic.init(); // init metronic core componets  
            Layout.init();   
            //FormWizard.init(); 
            ComponentsFormTools.init();
            //UITree.init();                
            $("#man").trigger("click");
        });
        $(document).on('change', '.excludes', function (e) {// when clicking the excludes button

            let data = new FormData();
            data.append('file', $(this)[0].files[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'orders/excludes',
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
                statusCode: {
                    419: function (data) {
                        alert('@lang('Your session expired! Try to reload the page.')')
                    },
                    422: function (data) {
                        alert(data.responseText)
                    }
                },
            }).done(function (data) {
                console.log(data);
                $('.your_choices_wrapper').empty().html(data.selected);
                $('.exclude-tab').empty().html(data.filters);
            })
        });

        $(document).on('change click', '.filters', function (e) {//when clicking and changing sex, age, live_type, phone number      
            console.log(999) ;
            $.ajax({
                url: '/orders/filters',
                method: 'POST',
                data: $('.filter-form').serialize(),
                statusCode: {
                    419: function (data) {
                        alert('@lang('Your session expired! Try to reload the page.')')
                    }
                }
            }).done(function (data) {                
                $('.your_choices_wrapper').empty().html(data);
            })
        });

        $(document).on('change', '.selected', function (e) {
            // console.log('selected cliecked', $(this).data('tab'));
            // let tab = $(this).data('tab');

            // $.ajax({
            //     url: '/orders/selected',
            //     method: 'POST',
            //     data: $('.filter-form').serialize() + '&tab=' + tab,
            //     statusCode: {
            //         419: function (data) {
            //             alert('@lang('Your session expired! Try to reload the page.')')
            //         }
            //     }
            // }).done(function (data) {
            //     $('.' + tab + '-tab').empty().html(data);
            // });
        });

        $(document).on('click', '.upd_btn', function (e) { //getting matching record count(OrderController@create)
            e.preventDefault();            
            console.log('update the matching record counts.')            
            Metronic.blockUI({
                boxed: true,
                message: 'searching...'
            });
            // $('.upd_records').attr("disabled", true).toggleClass('disabled').children('.upd_btn_loader').css({
            //     'display':'flex'
            // });

            // $('.upd_records').children('.upd_btn_text').css('display', 'none');
            console.log('selected form data', $('.filter-form').serialize());
            $.ajax({
                url: '/orders', //OrderController@create
                method: 'POST',
                data: $('.filter-form').serialize(),
                statusCode: {
                    419: function (data) {
                        alert('@lang('Your session expired! Try to reload the page.')')
                    }
                }
            }).done(function (data) {
                Metronic.unblockUI();                
                $('.records_count').empty().html(data);
            }).fail(function (data) {
                console.log(data)
            }).always(function () {
                
            });
        });

        $(document).on('submit', '.upd_form', function (e) {// setting the price
            e.preventDefault();
            console.log(90);
            console.log('update the price here!', $(this).serialize());
            let form = $(this);

            Metronic.blockUI({
                target: '#setting_price',
                boxed: true,
            });
            $.ajax({
                url: '/orders/counters',
                method: 'POST',
                data: $(this).serialize(),
                statusCode: {
                    419: function (data) {
                        alert('@lang('Your session expired! Try to reload the page.')')
                    },
                    422: function (data) {

                        for (let k in data.responseJSON.errors) {
                            console.log(k)
                            form.find('.' + k).html(data.responseJSON.errors[k])
                        }
                    }
                }
            }).done(function (data) {
                console.log(data);
                Metronic.unblockUI('#setting_price_section');
                $('.counters').empty().html(data);
            }).fail(function (data) {
                // console.log(data)
            })
        });

        $(document).on('click', '.confirm-button', function (e) {// go to the confirm page
            e.preventDefault();            
            Metronic.blockUI({               
                boxed: true,
                message: 'Processing...'
            });
            console.log('next screen here');
            location.href = '/orders/addressConfirm';
        })

        $(document).on('change', "input[name='filters[exclude]']", function (e) {
            console.log('changed');
            $('.exclude-wrapper').remove();
        })
    </script>
@endsection
