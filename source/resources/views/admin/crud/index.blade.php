<!DOCTYPE html><!--[if IE 7]>
<html lang="es" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="ie7"></html><![endif]--><!--[if IE 8]>
<html lang="es" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="ie8"></html><![endif]--><!--[if IE 9]>
<html lang="es" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="ie9"></html><![endif]-->
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="language" content="es">
    <title>Admin project</title>
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
          <h1> <a href="javascript:;">Administrador OSP</a></h1>
        </div>
        <div class="container-header__nav">
          <div class="container-header__nav-name">
            <p>Jean Paul Eduardo Diaz Vivanco </p>
          </div>
          <div class="container-header__nav-btn"><a href="javascript:;"><i class="icon icon-menu"></i></a></div>
        </div>
      </div>
    </header>
    <div class="container-wrapper">
      <ul class="container-sidebar">
        <li class="container-sidebar__option--active"><a href="{{ route('homeadmin') }}">Home</a></li>
        <li><a href="{{ action('Admin\CrudController@getIndex') }}">Crud</a></li>
        <li><a href="{{ action('Admin\ProfileController@getIndex') }}">Perfil</a></li>
        <li><a href="{{ url('admpanel/auth/logout') }}">Cerrar Sesión </a></li>
      </ul>
      <div id="wrapper" class="container-page">
        <h2>Listado</h2>
        <div class="panel-body"><a href="/admpanel/crud/form" class="btn btn-success">Nuevo</a></div>
        <section>
          <table id="categoryTable" data-url="/admpanel/crud/list" data-nofilter="1" data-col="name,action" class="tables table-striped">
            <thead>
              <tr class="info">
                <td>Nombre</td>
                <td class="action"></td>
              </tr>
            </thead>
          </table>
        </section>
      </div>
      <script type="text/template" id="tplEdit" data-initial="/dummies/edituser.json">
        <div class="modal-ctn">
          <form action="#" data-parsley-validate data-url="/dummies/edit.json" id="editForm">
            <input type="hidden" value="<%= id %>" name="id">
            <header>
              <h1>Editar Registro</h1>
            </header>
            <div class="modal-ctn--form">
              <div class="form-group">
                <input placeholder="Nombre" name="name" value="<%= name %>" data-parsley-required="true" class="form-control floating-label">
              </div>
              <div class="modal-ctn--actions">
                <button type="submit" class="btn btn-primary">Enviar</button>
              </div>
            </div>
          </form>
        </div>
      </script>
      <script type="text/template" id="tplDelete">
        <div class="modal-ctn">
          <form action="#" data-parsley-validate data-url="/dummies/delete.json" id="deleteForm">
            <input type="hidden" value="<%= id %>" name="id">
            <header>
              <h1>Confirmación</h1>
            </header>
            <div class="modal-ctn--form">
              <div class="form-group">
                <h4>¿Desea eliminar este registro?</h4>
              </div>
              <div class="modal-ctn--actions">
                <button type="submit" class="btn btn-primary">Eliminar</button><a href="javascript:;" class="btn btn-danger btn-danger--modal">Cancelar</a>
              </div>
            </div>
          </form>
        </div>
      </script>
      <script>
        window.alpha = {
        	module : 'index',
        	controller : 'crud',
        	action: 'index'
        };
      </script>
    </div>
    <script data-main="{{asset('static')}}/js/main" src="{{asset('static')}}/js/libs/requirejs/require.js"></script>
  </body>
</html>