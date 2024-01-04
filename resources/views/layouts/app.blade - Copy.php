<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Turn off "smart" recognition phone number -->
    <meta name="format-detection" content="telephone=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PrivatAdresser.se | Köp adresser till privatpersoner</title>

    <!-- Styles -->
    <!-- Style sheet link -->
    <link type="text/css" href="/css/main.css" rel="stylesheet" media="all">
    <link rel="shortcut icon" href="/img/favicon.png" type="image/png">
    @yield('stylesheets')
</head>
<body class="home lang-{{ app()->getLocale() }}">
    <header>
        <nav class="navbar navbar-expand-lg ">
            <a class="navbar-brand d-lg-none d-md-block" href="/">
                <div class="logo">
                    <img src="/img/header_logo.png" alt="alt">
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar"
                    aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon hamburger" id="hamburger-9">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
              </span>
            </button>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-1 col-md-12">
                                    <div class="logo d-lg-block d-md-none d-none">
                                        <a href="/"> <img src="/img/header_logo.png" alt="alt">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-12 ">
                                    <ul class="menu accordion justify-content-lg-center" id="accordionExample">
                                        <li>
                                            <a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                               aria-controls="collapseOne" class='menu_collapse'>@lang('data services')</a>
                                            <i class="fas fa-angle-down" ></i>
                                            <ul class="sub-menu" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                <li><a href="https://bizwell.se/adresser-till-foretag/">@lang('addresses to companies')</a></li>
                                                <li><a href="https://bizwell.se/adresser-till-privatpersoner/">@lang('addresses to consumers')</a></li>
                                                <li><a href="https://bizwell.se/mailadresser/">@lang('email addresses')</a></li>
                                                <li><a href="https://bizwell.se/kopa-leads/">@lang('lead generation')</a></li>
                                                <li><a href="https://bizwell.se/skicka-billiga-brev/">@lang('send letters at great prices')</a></li>
                                                <li><a href="https://bizwell.se/telefonlista/">@lang('calling list')</a></li>
                                                <li><a href="https://bizwell.se/marknadsundersokningar/">@lang('market research & surveys')</a></li>
                                                <li><a href="https://bizwell.se/internationella-register/">@lang('international business data')</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="https://bizwell.se/blog/">@lang('Blog')</a>
                                        </li>
                                        <li>
                                            <a href="https://bizwell.se/faq/">@lang('FAQ')</a>
                                        </li>
                                        <li>
                                            <a href="https://bizwell.se/om-bizwell-sweden-ab/">@lang('about bizwell')</a>
                                        </li>
                                        <li>
                                            <a href="https://bizwell.se/kontakta-bizwell/">@lang('contact')</a>
                                        </li>
                                    </ul>
                                </div>
                                {{--<div class="col-lg-2 col-md-12">
                                    <div class="right_side">
                                        <div class="search">
                                            <i class="fa fa-search searc-icon"></i>
                                            <div class="floating-search-bar">
                                                <form role="search" method="get" class="search-form" action="#">
                                                    <div class="form-row">
                                                        <input type="search" placeholder="Search..." value="" name="s" required="">
                                                        <button type="submit"><i class="fa fa-search"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <ul class="menu accordion" id="accordionLang">
                                            <li>
                                                <div class="language menu_collapse" data-toggle="collapse" data-target="#collapselang" aria-expanded="true"
                                                     aria-controls="collapselang">
                                                    <img src="/img/en.jpg" alt="alt" class="lang_img">
                                                    <span class="lang_text">EN</span>

                                                    <i class="fas fa-angle-down" ></i>
                                                </div>
                                                <ul class="sub-menu" id="collapselang" aria-labelledby="collapselang"
                                                    data-parent="#accordionLang">
                                                    <li>
                                                        <a href="#">
                                                            <img src="/img/sv.png" alt="alt" class="lang_img">
                                                            <span class="lang_text">SV</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>--}}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    @if (Session::has('flash_message'))
        <div class="container">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('flash_message') }}
            </div>
        </div>
    @endif

    <div class="container">
        @if(setting('import_running', 0))
            <div class="database_allert">
                ****** @lang('import_running') ******
            </div>
        @endif
        @yield('content')
    </div>

    <footer>
        <div class="container">

            <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer_logo">
                        <a href="index.html">
                            <img src="/img/footer_logo.png" alt="alt">
                        </a>
                    </div>
                    <ul class="footer_adress">
                        <li>Götgatan 87
                            116 62 Stockholm </li>
                        <li> <a href="tel:+460812442555">@lang('Phone:') +46(0)8 12 44 25 55 </a> </li>
                        <li> <a href="mailto:info@bizwell.se"> Email: info@bizwell.se</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="list_title">
                        @lang('Company')
                    </div>
                    <ul class="footer_list__links">
                        <li> <a href="https://bizwell.se/om-bizwell-sweden-ab/">
                                @lang('Abount BizWell')
                            </a>
                        </li>
                        <li>
                            <a href="https://bizwell.se/faq/">
                                @lang('FAQ')
                            </a> </li>
                        <li>
                            <a href="https://bizwell.se/blog/">
                                @lang('Blog')
                            </a>
                        </li>
                        <li>
                            <a href="https://bizwell.se/kontakta-bizwell/">
                                @lang('Contact')
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="list_title">
                        @lang('Data Services')
                    </div>
                    <ul class="footer_list__links">
                        <li> <a href="https://bizwell.se/mailadresser/">
                                @lang('Email addresses')

                            </a>
                        </li>
                        <li>
                            <a href="https://bizwell.se/adresser-till-foretag/">
                                @lang('Addresses to companies')
                            </a> </li>
                        <li>
                            <a href="https://bizwell.se/adresser-till-privatpersoner/">
                                @lang('Addresses to consumers')
                            </a>
                        </li>
                        <li>
                            <a href="https://bizwell.se/kopa-leads/">
                                @lang('Lead Generation')
                            </a>
                        </li>
                        <li>
                            <a href="https://bizwell.se/telefonlista/">
                                @lang('Calling lists')
                            </a>
                        </li>
                        <li>
                            <a href="https://bizwell.se/skicka-billiga-brev/">
                                @lang('Send letters at great prices')
                            </a>
                        </li>
                        <li>
                            <a href="https://bizwell.se/marknadsundersokningar/">
                                @lang('Market research & surveys')
                            </a>
                        </li>
                        <li>
                            <a href="https://bizwell.se/internationella-register/">
                                @lang('International business data')
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="list_title">
                        @lang('Other')
                    </div>
                    <ul class="footer_list__links">
                        <li> <a href="#">
                                @lang('Remote support')
                            </a>
                        </li>
                        <li>
                            <a href="http://b2b.bizwell.se/">
                                @lang('B2B Online Selection')
                            </a> </li>
                        <li>
                            <a href="http://inquiry.bizwell.se/">
                                @lang('B2B International Selection')
                            </a>
                        </li>
                        <li>
                            <a href="https://www.adresserdirekt.se/produkt/adresser-till-privatpersoner/">
                                @lang('B2C Online Selection')
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">

                <div class="col-12">
                    <div class="copyright">
                        COPYRIGHT © BIZWELL SWEDEN AB {{ date('Y') }}. ALL RIGHT RESERVED
                    </div>
                </div>

            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src='https://www.google.com/recaptcha/api.js?hl=en'></script>
    <script src="/js/main.js"></script>
    @yield('scripts')
</body>
</html>
