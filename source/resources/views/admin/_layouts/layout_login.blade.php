<!DOCTYPE html><!--[if IE 7]>
<html lang="es" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="ie7"></html><![endif]--><!--[if IE 8]>
<html lang="es" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="ie8"></html><![endif]--><!--[if IE 9]>
<html lang="es" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="ie9"></html><![endif]-->
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="language" content="es">
    <title>Admin Cligo</title>
    <meta name="title" content="Admin project">
    <meta name="description" content="Admin">
    <meta name="author" content="@paulrrdiaz, @jeanpaul1304, @jonico22">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="Keywords">
    <meta property="og:description" content="Admin">
    <meta property="og:image" content="/img/logo.png">
    <meta property="og:site_name" content="empty">
    <meta property="og:title" content="Admin project">
    <meta property="og:type" content="website">
    <meta property="og:url" content="/">
    <link href="/img/logo.png" rel="icon"><!--[if lte IE 9]>
    <link href="/css/modules/all/ie.css" media="all" rel="stylesheet" type="text/css">
    <script src="/js/dist/libs/selectivizr/selectivizr.js"></script>
    <script src="/js/dist/libs/html5shiv/dist/html5shiv.js"></script><![endif]-->
    <link href="{{asset('static')}}/js/libs/bootstrap/dist/css/bootstrap.css" media="all" rel="stylesheet" type="text/css">
    <link href="{{asset('static')}}/js/libs/bootstrap-material-design/dist/css/material-fullpalette.min.css" media="all" rel="stylesheet" type="text/css">
    <link href="{{asset('static')}}/js/libs/bootstrap-material-design/dist/css/material.min.css" media="all" rel="stylesheet" type="text/css">
    <link href="{{asset('static')}}/js/libs/bootstrap-material-design/dist/css/ripples.min.css" media="all" rel="stylesheet" type="text/css">
    <link href="{{asset('static')}}/js/libs/bootstrap-material-design/dist/css/roboto.min.css" media="all" rel="stylesheet" type="text/css">
    <link href="{{asset('static')}}/css/all.css" media="all" rel="stylesheet" type="text/css">
    <script src="{{asset('static')}}/js/libs/jquery/dist/jquery.js"></script>
  </head>
  <body>
    <header>
      <div class="container-header row">
        <div class="container-header__title">
          <h1> <a href="javascript:;">Administrador Cligo</a></h1>
        </div>
        <div class="container-header__nav">
          <div class="container-header__nav-name">
            <p> </p>
          </div>
          <div class="container-header__nav-btn"></div>
        </div>
      </div>
    </header>
    <div class="container-wrapper">
     @yield('content')
    </div>
    <script data-main="static/js/main" src="static/js/libs/requirejs/require.js"></script>
  </body>
</html>