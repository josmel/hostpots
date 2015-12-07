@extends('client._layouts.layout')
@section('content')
      <div id="wrapper"><br><br><br><br>
        <div class="content_soporte">
             {!!Form::model($admin,array('class'=>'formSoporte row','role'=>'form','files'=>'true','data-parsley-validate'))!!}
            {!!Form::input('hidden','id',null,array('class'=>'form-control'))!!}
            <div class="columna1">
              <div class="form_control">
                <label>(*) Nombres y apellidos</label>
                {!!Form::input('text','name_customer',null,array('required'))!!}
              </div>
              <div class="form_control">
                <label>(*) Email</label>
                {!!Form::input('email','email',null,array('data-parsley-type="email"','required'))!!}
              </div>
            </div>
            <div class="columna2">
              <div class="form_control">
                <label>(dejar vacío si no desea cambiar) Contraseña</label>
                {!!Form::password('password')!!}
              </div>
            </div>
          {!! Form::button('Save', array( 'type'=>'submit')) !!}
          {!!Form::close()!!}@if($errors->any())
          <ul class="alert alert-danger">@foreach($errors->all() as $error)
            <li>{{$error}}</li>@endforeach
          </ul>@endif
          <br><br>
        </div>
      </div>
  @stop