<!DOCTYPE html><!--[if IE 7]>
<html lang="es" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="ie7"></html><![endif]--><!--[if IE 8]>
<html lang="es" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="ie8"></html><![endif]--><!--[if IE 9]>
<html lang="es" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="ie9"></html><![endif]-->
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="language" content="es">
    <title>Cligo</title>
    <meta name="title" content="Cligo">
    <meta name="description" content="">
    <meta name="author" content="@paulrrdiaz, @jeanpaul1304, @jonico22">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="Keywords">
    <meta property="og:description" content="">
    <meta property="og:image" content="{{ URL::asset('/') }}img/logo.png">
    <meta property="og:site_name" content="OSP">
    <meta property="og:title" content="Cligo">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <link href="{{ URL::asset('/') }}css/all.css" media="all" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/') }}img/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href="{{ URL::asset('/') }}img/logo.png" rel="icon"><!--[if lte IE 9]>
      <script src="{{ URL::asset('/') }}js/vendor/selectivizr/selectivizr.js"></script>
      <script src="{{ URL::asset('/') }}js/vendor/html5shiv/dist/html5shiv.js"></script><![endif]-->
@yield('css')

  </head>
  <body>
    <header>
      <section>
        <h1><a href="{{ URL::asset('/') }}" title="Cligo"><img src="{{ URL::asset('/') }}img/cligo.png" atl="Cligo"></a></h1>
        <div class="menu-responsive"></div>
        <nav class="menu">
          <ul>
            <li class="{{ Request::is('nosotros') ? 'active' : '' }}"><a href="{{ URL::asset('nosotros') }}">Nosotros</a>
              <div class="flecha-up"></div>
            </li>
            <li class="hide-responsive"><span> 	</span></li>
            <li class="{{ Request::is('contactanos') ? 'active' : '' }}"><a href="{{ URL::asset('contactanos') }}">Contáctanos</a>
              <div class="flecha-up"></div>
            </li>
          </ul>
        </nav>
        <div class="buttons"><a href="#content_form_login" data-menu="1" class="btn--big login_popup">Login</a><a data-fancybox-type="iframe" href="{{ URL::asset('registrate') }}" class="btn--big popup">Regístrate</a></div>
      </section>
    </header>
    <div id="wrapper">
@yield('content')

    </div>
    <footer>
      <section><a href="{{ URL::asset('/') }}" title="Cligo" class="row"><img src="{{ URL::asset('/') }}img/cligo-footer.png" atl="Cligo"></a>
        <nav>
          <ul>
            <li><a href="{{ URL::asset('nosotros') }}">Nosotros</a></li>
            <li><a href="{{ URL::asset('trabaja') }}">Trabaja con nosotros</a></li>
            <li><a href="{{ URL::asset('terminos') }}">Términos y Condiciones</a></li>
            <li><a href="{{ URL::asset('comunidad') }}" class="footer_unete">Únete a la comunidad de repartidores</a></li>
            <li><a href="{{ URL::asset('preguntas-frecuentes') }}">Preguntas frecuentes</a></li>
            <li><a href="{{ URL::asset('contactanos') }}">Contáctanos</a></li>
          </ul>
        </nav>
      </section>
    </footer>
@yield('alpha')

    <div id="content_form_login">
      <div class="text-center main_login">
        <h2>Login</h2>
        <form data-parsley-validate data-mcs-theme="dark" method="post" action="{{ url('/login') }}" id="form_login" class="mCustomScrollbar">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-control">
            <div class="form-input">
              <input type="text" name="email" value="{{ old('email') }}" placeholder="(*) Email" data-parsley-type="email" required>
            </div>
            <div class="form-input">		
              <input type="password" name="password" placeholder="(*) Contraseña" data-parsley-maxlength="11" required>
            </div>
          </div>
          <div class="form-control">
            <p>(*) campo obligatorio	</p>
          </div>
          <div class="form-control">
            <input type="submit" value="Enviar" class="btn btn--skyblue btn--big">
          </div>
          <p>¿Olvidaste tu contraseña? <a href="#content_form_recuperar" class="login_popup">Click aquí			</a></p>
        </form>
      </div>
    </div>
    <div id="content_form_recuperar">
      <div class="text-center main_recuperar">
        <h2>Recuperar contraseña</h2>
        <form data-parsley-validate data-mcs-theme="dark" class="form-ctn-joinus mCustomScrollbar form-recuperar">			
          <div class="form-control">
            <div class="form-input">
              <input type="text" placeholder="Email" data-parsley-type="email" required>
            </div>
          </div>
          <div class="form-control">
            <input type="submit" value="Enviar" class="btn btn--skyblue btn--big">
          </div>
        </form>
      </div>
    </div>
    <script src="{{ URL::asset('/') }}js/vendor/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script data-main="{{ URL::asset('/') }}js/main" src="{{ URL::asset('/') }}js/vendor/requirejs/require.js"></script>
  </body>
</html>