@extends('layouts.test')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page_name">
                @lang('Addresses to individuals')
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <form action="#" class="search_form filter-form">
                @csrf
                <div class="search_field">
                    <ul class="nav nav-pills " id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="gender-tab" data-toggle="pill" href="#gender" role="tab"
                                aria-controls="gender" aria-selected="true">@lang('Gender')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="age-tab" data-toggle="pill" href="#age" role="tab" aria-controls="age"
                                aria-selected="false">@lang('Age')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="geography-tab" data-toggle="pill" href="#geography" role="tab"
                                aria-controls="geography" aria-selected="false">@lang('Geography')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="living_type-tab" data-toggle="pill" href="#living_type" role="tab"
                                aria-controls="living_type" aria-selected="false">@lang('Living type')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="phone_numbers-tab" data-toggle="pill" href="#phone_numbers" role="tab"
                                aria-controls="phone_numbers" aria-selected="false">@lang('Phone numbers')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="exclude_your_own_data-tab" data-toggle="pill" href="#exclude_your_own_data"
                                role="tab" aria-controls="exclude_your_own_data" aria-selected="false">@lang('Exclude your own data')</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="gender" role="tabpanel" aria-labelledby="gender-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 gender-tab">
                                        @include('orders.partials-test.gender-tab')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="age" role="tabpanel" aria-labelledby="age-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 age-tab">
                                        @include('orders.partials-test.age-tab')
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="geography" role="tabpanel" aria-labelledby="geography-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 geography-tab">
                                        @include('orders.partials-test.geography-tab')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="living_type" role="tabpanel" aria-labelledby="living_type-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 living-tab">
                                        @include('orders.partials-test.living-tab')
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="phone_numbers" role="tabpanel" aria-labelledby="phone_numbers-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 phone-tab">
                                        @include('orders.partials-test.phone-tab')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="exclude_your_own_data" role="tabpanel" aria-labelledby="exclude_your_own_data-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 exclude-tab">
                                        @include('orders.partials-test.exclude-tab')
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 your_choices_wrapper">
                            @include('orders.partials-test.selected')
                        </div>
                    </div>
                </div>
            </form>

            <form action="#" class="upd_form" enctype="multipart/form-data">
                @csrf
                <div class="upd_form_wrapper">
                    <div class="row">

                        <div class="col-lg-8 col-md-6 col-sm-12">

                            <label for="purchase_amount">
                                <p>@lang('Enter the desired number to purchase')</p>
                                <input type="number" min="1" required name="number_to_purchase" value="{{ $order->number_to_purchase ? $order->number_to_purchase : $order->matching_records }}">
                                <p class="error number_to_purchase"></p>
                            </label>

                            <label for="discount_code">
                                <p>@lang('Discount code')</p>
                                <input type="text" name="discount_code" value="{{ $order->discount_code }}">
                            </label>

                            <button type="submit" class="upd_btn">@lang('Update price')</button>

                        </div>

                        <div class="col-lg-4  col-md-6 col-sm-12 counters">
                            @include('orders.partials-test.counters')
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-right">
                        <button type="button" class="next_btn upd_btn confirm-button">@lang('Next') <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).on('change', '.excludes', function (e) {

            let data = new FormData();
            data.append('file', $(this)[0].files[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'test/excludes',
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
                $('.your_choices_wrapper').empty().html(data.selected);
                $('.exclude-tab').empty().html(data.filters);
            })
        });

        $(document).on('change', '.filters', function (e) {
            console.log('filter changed here.');
            console.log($('.filter-form').serialize());
            $.ajax({
                url: '/test/filters',
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

            let tab = $(this).data('tab');

            $.ajax({
                url: '/test/selected',
                method: 'POST',
                data: $('.filter-form').serialize() + '&tab=' + tab,
                statusCode: {
                    419: function (data) {
                        alert('@lang('Your session expired! Try to reload the page.')')
                    }
                }
            }).done(function (data) {
                $('.' + tab + '-tab').empty().html(data);
            });
        });

        $(document).on('submit', '.filter-form', function (e) {
            e.preventDefault();
            console.log("$('.filter-form').serialize()", $('.filter-form').serialize());
            $('.upd_records').attr("disabled", true).toggleClass('disabled').children('.upd_btn_loader').css({
                'display':'flex'
            });

            $('.upd_records').children('.upd_btn_text').css('display', 'none');

            $.ajax({
                url: '/test',
                method: 'POST',
                data: $('.filter-form').serialize(),
                statusCode: {
                    419: function (data) {
                        alert('@lang('Your session expired! Try to reload the page.')')
                    }
                }
            }).done(function (data) {
                console.log(data);
                $('.records_count').empty().html(data);
            }).fail(function (data) {
                // console.log(data)
            }).always(function () {
                $('.upd_records').attr("disabled", false).removeClass('disabled').children('.upd_btn_loader').css({
                    'display':'none'
                });
                $('.upd_records').children('.upd_btn_text').css('display', 'block');
            });
        });

        $(document).on('submit', '.upd_form', function (e) {
            e.preventDefault();
            console.log('update the price here!');
            let form = $(this);
            $.ajax({
                url: '/test/counters',
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
                $('.counters').empty().html(data)
            }).fail(function (data) {
                // console.log(data)
            })
        });

        $(document).on('click', '.confirm-button', function (e) {
            e.preventDefault();
            location.href = '/test/confirm';
        })

        $(document).on('change', "input[name='filters[exclude]']", function (e) {
            console.log('changed');
            $('.exclude-wrapper').remove()
        })
    </script>
@endsection
