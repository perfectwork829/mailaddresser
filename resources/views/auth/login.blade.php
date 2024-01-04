@extends('layouts.app')
@section('stylesheets')
<link type="text/css" href="/css/custom.css" rel="stylesheet" media="all">
@endsection
@section('content')
<div class="upsell_info_wrapper">
    <div class="row justify-content-center">
        <div class="col-md-offset-3 col-md-6">
            <div class="portlet box sale-primary-color sales_form_wizard">
                <div class="portlet-title para-color">
                    <div class="caption">
                        <i class="fa fa-sign-in"></i>{{ __('Login') }}
                    </div>
                    <div class="actions">
                        
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-body">                    
                            <div class="form-group row padding-login-row mb-0">
                                <label for="email" class="offset-md-2 col-md-2 col-form-label icon-state-warning text-left">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row padding-login-row mb-0">
                                <label for="password" class="offset-md-2 col-md-2 col-form-label icon-state-warning text-left">{{ __('Password') }}</label>
                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row padding-login-row mb-0">
                                <div class="col-md-8 offset-md-2">
                                    <div class="form-check">
                                        <input class="styled-checkbox filters" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember" class="category_sub_title icon-state-warning">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>                           
                        </div> 
                        <div class="form-actions">
                            <div class="form-group row mb-0">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>   
                    </form>                
                </div>  
            </div>                      
        </div>
    </div>
</div>
@endsection
