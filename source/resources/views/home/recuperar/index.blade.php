
@extends('home._layouts.iframe')

@section('css')

<link href="{{ URL::asset('/') }}css/all.css" media="all" rel="stylesheet" type="text/css"/>
@stop

@section('content')

<div class="text-center main_recuperar">
  <form data-parsley-validate="data-parsley-validate" data-mcs-theme="dark" class="form-ctn-joinus mCustomScrollbar form-recuperar">
    <h2>Recuperar contraseña</h2>
    <div class="form-control">
      <div class="form-input">
        <input type="text" placeholder="Email" data-parsley-type="email" required="required"/>
      </div>
    </div>
    <div class="form-control">
      <input type="submit" value="Enviar" class="btn btn--skyblue btn--big"/>
    </div>
    <!--.form-control-->
    <!--		a(href="/login") Regresar		-->
  </form>
</div>
@section('alpha')

<script>
  window.alpha = {
  	module : 'cligo',
  	controller : 'index',
  	action: 'registrate'
  }
</script>
@stop

<script src="{{ URL::asset('/') }}js/vendor/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script data-main="{{ URL::asset('/') }}js/main" src="{{ URL::asset('/') }}js/vendor/requirejs/require.js"></script>
@stop
