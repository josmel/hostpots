<!DOCTYPE html><!--[if IE 7]>
<html lang="es" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="ie7"></html><![endif]--><!--[if IE 8]>
<html lang="es" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="ie8"></html><![endif]--><!--[if IE 9]>
<html lang="es" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="ie9"></html><![endif]-->
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="language" content="es">
        <title>HostPots</title>
        <meta name="title" content="Cligo">
        <meta name="description" content="Cligo">
        <meta name="author" content="@paulrrdiaz, @jeanpaul1304, @jonico22">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="index, follow">
        <meta name="keywords" content="Keywords">
        <meta property="og:description" content="Cligo">
        <!--<meta property="og:image" content="{{ URL::asset('/') }}/img/logo.png">-->
        <meta property="og:site_name" content="empty">
        <meta property="og:title" content="Cligo">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ URL::asset('/') }}">
        <!--<link href="{{ URL::asset('/') }}/img/logo.png" rel="icon">[if lte IE 9]>
        <link href="{{ asset('client/') }}/css/modules/all/ie.css" media="all" rel="stylesheet" type="text/css">
        <script src="{{ asset('client/') }}/js/dist/libs/selectivizr/selectivizr.js"></script>
        <script src="{{ asset('client/') }}/js/dist/libs/html5shiv/dist/html5shiv.js"></script><![endif]-->
        <link href="{{ asset('client/') }}/css/all.css" media="all" rel="stylesheet" type="text/css">
    </head>
    <body class="l-site">
        <aside class="l-nav">
            <nav class="nav">
                <ul>
                    <li><i class="icon icon-perfil_off i-person"></i><span>{{Auth::customer()->user()->name_customer}}		</span></li>
                    <li class="{{ Request::is('admclient/solicitar') ? 'activo' : '' }}"><a href="{{ URL::asset('admclient/solicitar') }}">
                            <div class="bg_icon"><i class="icon icon-solicitar_servicio_off i-servicio"></i></div><span>Solicitar servicio</span></a></li>
                    <li class="{{ Request::is('admclient/activos') ? 'activo' : '' }}"><a href="{{ action('Client\RequestController@getActivos') }}">
                            <div class="bg_icon"><i class="icon icon-servicios_activos_off i-activos"></i></div><span>Servicios activos</span></a></li>
                    <li class="{{ Request::is('admclient/perfil') ? 'activo' : '' }}"><a href="{{ URL::asset('admclient/perfil') }}">
                            <div class="bg_icon"><i class="icon icon-perfil_off i-person"></i></div><span>Perfil</span></a></li>
                    <li class="{{ Request::is('admclient/client') ? 'activo' : '' }}"><a href="{{ URL::asset('admclient/client') }}">
                            <div class="bg_icon"><i class="icon icon-soporte_off i-soporte"></i></div><span>Equipos</span></a></li>
                    <li class="{{ Request::is('admclient/campanias') ? 'activo' : '' }}"><a href="{{ URL::asset('admclient/campanias') }}">
                            <div class="bg_icon"><i class="icon icon-soporte_off i-soporte"></i></div><span>Campañas</span></a></li>
                    <li class="{{ Request::is('admclient/analytics') ? 'activo' : '' }}"><a href="{{ URL::asset('admclient/analytics') }}">
                            <div class="bg_icon"><i class="icon icon-soporte_off i-soporte"></i></div><span>Soporte</span></a></li>

                </ul>
            </nav>
        </aside>
        <div class="l-page">
            <header class="row">
                <div class="menu">
                    <div class="menu-hamburger"></div>
                </div>
                <h1><a href="{{ URL::asset('admclient') }}"><img width="40%" src="http://scitechscholar.com/wp-content/uploads/2015/04/wifi-hotspot.jpg" alt=""></a></h1>
<!--                <div class="credito"><a href="#"><i class="icon icon-dolar"></i></a>
                    <p><span>CRÉDITO DISPONIBLE</span><br><strong>S./ {{Auth::customer()->user()->credit}}</strong></p>
                </div>-->
                <div class="logout"><a href="{{url('logout')}}"><span class="user">{{Auth::customer()->user()->name_customer}} -  &nbsp;&nbsp;</span><span class="off">DESLOGUEARSE</span><img src="{{ asset('client/img/salir.png') }}" alt=""></a></div>
            </header>
            @yield('content')
        </div>
        <script>
            window.alpha = {
                module: 'index',
                controller: '{{$controller}}',
                action: '{{$action}}'
            };
        </script>
        <script src="{{ asset('client/') }}/js/libs/jquery/dist/jquery.min.js" type="text/javascript"></script>
        <script data-main="{{ asset('client/') }}/js/main" src="{{ asset('client/') }}/js/libs/requirejs/require.js"></script>
    </body>
</html>