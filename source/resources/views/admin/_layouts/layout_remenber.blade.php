<!DOCTYPE html><!--[if IE 7]>
<html lang="es" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="ie7"></html><![endif]--><!--[if IE 8]>
<html lang="es" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="ie8"></html><![endif]--><!--[if IE 9]>
<html lang="es" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="ie9"></html><![endif]-->
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="language" content="es">
    <title>Project Ibody </title>
    <meta name="title" content="Project Ibody ">
    <meta name="description" content="Admin">
    <meta name="author" content="undefined">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="Keywords">
    <meta property="og:description" content="Admin">
    <meta property="og:image" content="{{Request::root()}}img/logo.png">
    <meta property="og:site_name" content="undefined">
    <meta property="og:title" content="Project Ibody ">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{Request::root()}}">
    <link href="{{Request::root()}}img/logo.png" rel="icon"><!--[if lte IE 9]>
      <link href="{{Request::root()}}/static/css/modules/all/ie.css" media="all" rel="stylesheet" type="text/css">
      <script src="{{Request::root()}}/static/js/dist/libs/selectivizr/selectivizr.js"></script>
      <script src="{{Request::root()}}/static/js/dist/libs/html5shiv/dist/html5shiv.js"></script><![endif]-->
  </head>
  <link href="{{Request::root()}}/static/js/libs/bootstrap/dist/css/bootstrap.css" media="all" rel="stylesheet" type="text/css">
  <link href="{{Request::root()}}/static/js/libs/bootstrap-material-design/dist/css/material-fullpalette.min.css" media="all" rel="stylesheet" type="text/css">
  <link href="{{Request::root()}}/static/js/libs/bootstrap-material-design/dist/css/material.min.css" media="all" rel="stylesheet" type="text/css">
  <link href="{{Request::root()}}/static/js/libs/bootstrap-material-design/dist/css/ripples.min.css" media="all" rel="stylesheet" type="text/css">
  <link href="{{Request::root()}}/static/js/libs/bootstrap-material-design/dist/css/roboto.min.css" media="all" rel="stylesheet" type="text/css">
  <link href="{{Request::root()}}/static/css/all.css" media="all" rel="stylesheet" type="text/css">
  <script src="{{Request::root()}}/static/js/libs/jquery/dist/jquery.js"></script>
  <body>
    <header>
      <div class="container-header row">
        <div class="container-header__title">
          <h1> <a href="javascript:;">App Admin - Cligo</a></h1>
        </div>@if(!Auth::admin()->guest())@endif
      </div>
    </header>
    <div class="container-wrapper row">@yield('content')</div>
    <script>
      window.alpha = {
          module: 'index',
          controller: '{{$controller}}' ,
          action: '{{$action}}'
      };
    </script>
    <script data-main="{{Request::root()}}/static/js/main" src="{{Request::root()}}/static/js/libs/requirejs/require.js"></script>
    <script>
      window.alpha = {
          module: 'index',
          controller: '{{$controller}}' ,
          action: '{{$action}}'
      };
    </script>
  </body>
</html>