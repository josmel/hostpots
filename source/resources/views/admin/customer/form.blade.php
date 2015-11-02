
@extends('admin._layouts.layout')
@section('content')
<div id="wrapper" class="container-page">@if(isset($data->id))
    <h2>Editar Customer</h2>@else
    <h2>Registrar Customer</h2>@endif
    {!! Form::model($data, ['files'=>'true','method'=>'post', 'data-parsley-validate'=>'data-parsley-validate']) !!}
    <div class="form-upload">
        {!! Form::hidden('id',  $data->id ) !!}
        <div class="form-group">{!! Form::text('name_customer', null , ['placeholder'=>'Nombre', 'class' => 'form-control floating-label'])!!}</div>
        <div class="form-group">{!! Form::text('ruc', null , ['placeholder'=>'Ruc', 'class' => 'form-control floating-label'])!!}</div>
        <div class="form-group">{!! Form::text('phone', null , ['placeholder'=>'Teléfono', 'class' => 'form-control floating-label'])!!}</div>
        <div class="form-group">{!! Form::text('credit', null , ['placeholder'=>'Creditos', 'class' => 'form-control floating-label'])!!}</div>
        <div class="form-group">
            <div class="form-group">{!! Form::text('email', null , ['placeholder'=>'Email', 'class' => 'form-control floating-label'])!!}</div>    
            @if(empty($data->id))
            <div class="form-group">{!!Form::password('password',array('class'=>'form-control floating-label','placeholder'=>$msgform))!!}</div>@endif
            <div class="form-group">
                <button type="submit" class="btn btn-primary">SEND</button>
            </div>{!! Form::close() !!}
            @if($errors->any())
            <ul class="alert alert-danger">@foreach($errors->all() as $error)
                <li>{{$error}}</li>@endforeach
            </ul>@endif
        </div>
    </div>@stop