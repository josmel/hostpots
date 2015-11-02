
@extends('admin._layouts.layout_remenber')
@section('content')
<div id="wrapper" class="container-page">
  <h2>Change your Password</h2>{!! Form::model($data, ['files'=>'true','method'=>'post', 'data-parsley-validate'=>'data-parsley-validate', 'url'=>'/remenber']) !!}
  <div class="form-upload">{!! Form::hidden('token',  $data->tokenremenber) !!}
    <div class="form-group">{!! Form::password('password', ['placeholder'=>'Password', 'name'=>'password', 'class' => 'form-control floating-label', 'id'=>'password'])!!}</div>
    <div class="form-group">{!! Form::password('repassword', ['placeholder'=>'Confirm Password', 'name'=>'repassword', 'class' => 'form-control floating-label', 'data-parsley-equalto'=>'#password'])!!}</div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">Enviar</button>
    </div>{!! Form::close() !!}
  </div>
</div>@stop