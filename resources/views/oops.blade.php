@extends('layouts.app')

@section('content')
<h3>something went wrong.</h3>
    <div class="row">
        <div class="col-12">
            @if (isset($errors) && $errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="upsell_info_wrapper">
                <h2>
                    @lang('Oops, something went wrong!')
                </h2>
                <h3>
                    @lang('Check your solvency and try again. Or contact us if there is a malfunction in the site!')
                </h3>
            </div>
        </div>
    </div>
@endsection
