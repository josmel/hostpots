@extends('client._layouts.layout')
@section('content')
      <div id="wrapper"><br><br><br><br>
        <div class="content_soporte">
             {!!Form::model($admin,array('class'=>'formSoporte row','role'=>'form','files'=>'true','data-parsley-validate'))!!}
            {!!Form::input('hidden','id',null,array('class'=>'form-control'))!!}
          <!--<form data-parsley-validate class="formSoporte row">-->
            <div class="columna1">
              <div class="form_control">
                <label>(*) Nombres y apellidos</label>
                {!!Form::input('text','name_customer',null,array('required'))!!}
              </div>
              <div class="form_control">
                <label>(*) Email</label>
                {!!Form::input('email','email',null,array('data-parsley-type="email"','required'))!!}
                <!--<input type="text" name="email" required data-parsley-type="email">-->
              </div>
            </div>
            <div class="columna2">
              <div class="form_control">
                <label>(dejar vacío si no desea cambiar) Contraseña</label>
                {!!Form::password('password')!!}
              </div>
            </div>
          {!! Form::button('Save', array( 'type'=>'submit')) !!}
            <!--<button type="submit">Guardar</button>-->
          {!!Form::close()!!}@if($errors->any())
          <ul class="alert alert-danger">@foreach($errors->all() as $error)
            <li>{{$error}}</li>@endforeach
          </ul>@endif
          @if($messageSuccess)
          <ul class="alert alert-success">
            <li>{{$messageSuccess}}</li>
          </ul>@endif<br><br><br>
        </div>
      </div>
  @stop