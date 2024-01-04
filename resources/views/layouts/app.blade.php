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
    <!-- <link type="text/css" href="/css/main.css" rel="stylesheet" media="all"> -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link type="text/css" href="/css/font-awesome.css" rel="stylesheet" media="all">
    <link type="text/css" href="/css/bootstrap.min.css" rel="stylesheet" media="all">
    <!-- <link type="text/css" href="/css/jstree/style.min.css" rel="stylesheet" media="all"> -->
    <link type="text/css" href="/css/components-rounded.css" rel="stylesheet" media="all">
    <link type="text/css" href="/css/plugins.css" rel="stylesheet" media="all">
    <link type="text/css" href="/css/layout.css" rel="stylesheet" media="all">

    <!-- <link rel="shortcut icon" href="/img/favicon.png" type="image/png"> -->
    <link rel="shortcut icon" href="/img/Favicon-Default.ico" type="image/ico">
    @yield('stylesheets')
</head>
<body class="page-header-fixed page-quick-sidebar-over-content home lang-{{ app()->getLocale() }}">
     <!-- Header BEGIN -->
    <div class="wrapper">
        <header class="page-header">
            <nav class="navbar mega-menu" role="navigation">
            <div class="container-fluid">
                <div class="clearfix navbar-fixed-top">
                
                <!-- BEGIN LOGO -->
                <a id="index" class="page-logo" href="{{route('home')}}">
                    <img src="{{asset('img/logo.png')}}" alt="Logo">
                </a>
                <!-- END LOGO -->              
                </div>
            </div>
            <!--/container-->
            </nav>
        </header>
        <!-- Header END -->       

        <div class="container-fluid main-content">
            @if(setting('import_running', 0))
                <div class="database_allert">
                    ****** @lang('import_running') ******
                </div>
            @endif
            @yield('content')
            <!-- BEGIN QUICK SIDEBAR -->
            <a href="javascript:;" class="page-quick-sidebar-toggler">
            <i class="icon-login"></i>
            </a>
            <!-- END QUICK SIDEBAR -->  
        </div>
    </div>

    <footer class="wraper_footer style-seven">
        <!-- wraper_footer_main -->
        <div class="wraper_footer_main">
          <div class="container">
            <!-- row -->
            <div class="row footer_main">
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="footer_main_item matchHeight" style="height: 464px;">
                  <section id="text-4" class="widget widget_text">
                    <h5 class="widget-title">Om Oss</h5>
                    <div class="textwidget">
                      <p>AdressFakta.se ägs av <a href="https://www.supereroi.se">SUPEReROI AB</a> och levererar adresser till företag och adresser till privatpersoner. Om du vill köpa leads eller genomföra en marknadsföringskampanj så är du välkommen att kontakta oss. </p>
                      <p>
                        <a href="/cookies">Cookies</a>
                        <br>
                        <a href="/integritetspolicy">Integritetspolicy</a>
                        <br>
                        <a href="/kopvillkor">Köpvillkor</a>
                      </p>
                    </div>
                  </section>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="footer_main_item matchHeight" style="height: 464px;">
                  <section id="block-3" class="widget widget_block">
                    <h5 class="widget-title">Populära register</h5>
                    <div class="textwidget">
                      <p>
                        <strong>
                          <a href="https://www.adressfakta.se/adresser-till-nystartade-foretag/">Adresser till vårdcentraler</a>
                        </strong>
                      </p>
                      <p>
                        <strong>
                          <a href="https://www.adressfakta.se/adresser-till-vardcentraler/">Adresser till nystartade företag</a>
                        </strong>
                      </p>
                      <p>
                        <strong>
                          <a href="https://www.adressfakta.se/adresser-till-rektorer/">Adresser till rektorer</a>
                        </strong>
                      </p>
                      <p>
                        <strong>
                          <a href="https://www.adressfakta.se/adresser-till-skolor-och-universitet/">Adresser till skolor och universitet</a>
                        </strong>
                      </p>
                      <p>
                        <strong>
                          <a href="https://www.adressfakta.se/adresser-till-lakare/">Adresser till läkare</a>
                        </strong>
                      </p>
                      <p>
                        <strong>
                          <a href="https://www.adressfakta.se/adresser-till-sjukskoterskor/">Adresser till sjuksköterskor</a>
                        </strong>
                      </p>
                      <p>
                        <strong>
                          <a href="https://www.adressfakta.se/adresser-till-bilagare/">Adresser till bilägare</a>
                        </strong>
                      </p>
                      <p>
                        <strong>
                          <a href="https://www.adressfakta.se/adresser-till-forskolor/">Adresser till förskolor</a>
                        </strong>
                      </p>
                      <p>
                        <strong>
                          <a href="https://www.adressfakta.se/adresser-till-bostadsrattsforeningar/">Adresser till bostadsrättsföreningar</a>
                        </strong>
                      </p>
                    </div>
                  </section>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="footer_main_item matchHeight" style="height: 464px;">
                  <section id="block-4" class="widget widget_block">
                    <h5 class="widget-title">Tjänster</h5>
                    <div class="textwidget">
                      <p>
                        <strong>
                          <a href="https://www.adressfakta.se/adresser-till-privatpersoner">Adresser till privatpersoner</a>
                        </strong>
                      </p>
                      <p></p>
                      <p>
                        <strong>
                          <a href="https://www.adressfakta.se/adresser-till-foretag/">Adresser till företag</a>
                        </strong>
                      </p>
                      <p>
                        <strong>
                          <a href="https://www.adressfakta.se/kopa-leads/">Köpa leads</a>
                        </strong>
                      </p>
                      <p>
                        <strong>
                          <a href="https://www.adressfakta.se/telefonlista/">Telefonlista</a>
                        </strong>
                      </p>
                      <p>
                        <strong>
                          <a href="https://www.adressfakta.se/direktreklam-utskick/">Direktreklam</a>
                        </strong>
                      </p>
                      <p>
                        <strong>
                          <a href="https://www.adressfakta.se/edr-mailutskick/">Mailutskick</a>
                        </strong>
                      </p>
                      <p>
                        <strong>
                          <a href="https://www.adressfakta.se/mailadresser/">Mailadresser</a>
                        </strong>
                      </p>
                      <p>
                        <strong>
                          <a href="https://www.adressfakta.se/foretagsregister/">Företagsregister</a>
                        </strong>
                      </p>
                      <p>
                        <strong>
                          <a href="https://www.adressfakta.se/spar-registret/">SPAR-registret</a>
                        </strong>
                      </p>
                    </div>
                  </section>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="footer_main_item matchHeight" style="height: 464px;">
                  <section id="text-5" class="widget widget_text">
                    <h5 class="widget-title">Kontakta Oss</h5>
                    <div class="textwidget">
                      <p>
                        <strong>Adress</strong>
                        <br> Götgatan 87 <br> 116 62 Stockholm
                      </p>
                      <p>
                        <strong>Email:</strong>
                        <a href="https://www.adressfakta.se/kontakta-oss">Till formuläret</a>
                      </p>
                    </div>
                  </section>
                </div>
              </div>
            </div>
            <!-- row -->
          </div>
        </div>
        <!-- wraper_footer_main -->
        <!-- wraper_footer_copyright -->
        <div class="wraper_footer_copyright">
          <div class="container">
            <!-- row -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- footer_copyright -->
                <div class="footer_copyright">
                  <p>© AdressFakta 2023</p>
                </div>
                <!-- footer_copyright -->
              </div>
            </div>
            <!-- row -->
          </div>
        </div>
        <!-- wraper_footer_copyright -->
      </footer>
    
    <a href="#index" class="go2top">
      <i class="icon-arrow-up"></i>
    </a>
    
    <script src="/js/jquery.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js?hl=en'></script>
    <script src="/js/main.js"></script>
    @yield('scripts')
</body>
</html>
