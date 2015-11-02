
@extends('admin._layouts.layout')
@section('content')
<div id="wrapper" class="container-page">@if(isset($data->id))
    <h2>Editar Driver</h2>@else
    <h2>Registrar Driver</h2>@endif
    {!! Form::model($data, ['files'=>'true','method'=>'post', 'data-parsley-validate'=>'data-parsley-validate']) !!}
    <div class="form-upload">
        {!! Form::hidden('id',  $data->id ) !!}
        {!! Form::hidden('picture',  $data->picture, ['id'=>'image-rountine'] ) !!}
        <div class="form-group">{!! Form::text('namedriver', null , ['placeholder'=>'Nombre', 'class' => 'form-control floating-label'])!!}</div>
        <div class="form-group">{!! Form::text('lastname', null , ['placeholder'=>'Apellido', 'class' => 'form-control floating-label'])!!}</div>
        <div class="form-group">{!! Form::text('dni', null , ['placeholder'=>'Dni', 'class' => 'form-control floating-label'])!!}</div>
        <div class="form-group">{!! Form::text('phone', null , ['placeholder'=>'Teléfono', 'class' => 'form-control floating-label'])!!}</div>
        <div class="form-group">{!! Form::text('placa_vehicle', null , ['placeholder'=>'Placa', 'class' => 'form-control floating-label'])!!}</div>
        <div class="form-group">
        <div class="form-group">{!! Form::text('email', null , ['placeholder'=>'Email', 'class' => 'form-control floating-label'])!!}</div>    
            @if(empty($data->id))
            <div class="form-group">{!!Form::password('password',array('class'=>'form-control floating-label','placeholder'=>$msgform))!!}</div>@endif
            <div class="form-group">{!! Form::select('driver_state_id', $typeDriverState, $data->driver_state_id, ['class'=>'form-control', 'data-parsley-required'=>'data-parsley-required', 'name' =>'driver_state_id']) !!}</div>
            <div class="form-group">{!! Form::select('vehicletype_id', $Vehicletype, $data->vehicletype_id, ['class'=>'form-control', 'data-parsley-required'=>'data-parsley-required', 'name' =>'vehicletype_id']) !!}</div>

             <div class="form-group">
      <!--input type="file" requiredfile="requiredfile" data-show-upload="false" name="picture" class="js-uploadInput"/-->
      <input type="file" id="uploadImgOne" data-hidden-id="#image-rountine" data-show-upload="false" data-allowed="jpg,png,gif" name="picture" data-format="image"  class="js-uploadInput"/>
      <button type="submit" class="btn btn-primary">SEND</button>
    </div>{!! Form::close() !!}
    @if($errors->any())
    <ul class="alert alert-danger">@foreach($errors->all() as $error)
      <li>{{$error}}</li>@endforeach
    </ul>@endif
  </div>
</div>@stop