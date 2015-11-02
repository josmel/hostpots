
@extends('home._layouts.iframe')

@section('css')

<link href="{{ URL::asset('/') }}css/all.css" media="all" rel="stylesheet" type="text/css"/>
@stop

@section('content')

<div class="text-center main_login">@if(session()->has('messageSuccess'))
  <ul role="alert" class="alert alert-success alert-dismissible">
    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true">&times;</span></button>
    <li>{{session('messageSuccess')}}</li>
  </ul>@endif
  @if (count($errors) > 0)
  <div class="alert alert-danger">Sus credenciales son incorrectas.<br/>
    <ul>@foreach ($errors->all() as $error)
      <li>{{ $error }}</li>@endforeach
    </ul><br/>
  </div>@endif
  <form data-parsley-validate="data-parsley-validate" data-mcs-theme="dark" method="post" action="{{ url('/login') }}" id="form_login" class="form-ctn-joinus mCustomScrollbar">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    <h2>Login</h2>
    <div class="form-control">
      <div class="form-input">
        <input type="text" name="email" value="{{ old('email') }}" placeholder="Email" data-parsley-type="email" required="required"/><span class="block_required">(*)</span>
      </div><br/><br/>
      <div class="form-input">		
        <input type="password" name="password" placeholder="Contraseña" data-parsley-maxlength="11" required="required"/><span class="block_required">(*)</span>
      </div>
    </div>
    <div class="form-control">
      <input type="submit" value="Enviar" class="btn btn--skyblue btn--big"/>
    </div>
    <p>¿Olvidaste tu contraseña? <a data-fancybox-type="iframe" href="{{ URL::asset('recuperar') }}" class="login_popup">Click aquí			</a></p>
    <p class="cancel-login"><a href="/">Cancelar</a></p>
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
