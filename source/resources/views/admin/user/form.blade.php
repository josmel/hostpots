
@extends('admin._layouts.layout')
@section('content')
<div id="wrapper" class="container-page">@if(isset($data->id))
  <h2>Edit of User</h2>@else
  <h2>Register of User</h2>@endif
  {!! Form::model($data, ['files'=>'true','method'=>'post', 'data-parsley-validate'=>'data-parsley-validate', 'url'=>'/admpanel/user']) !!}
  <div class="form-upload">
    {!! Form::hidden('id',  $data->id ) !!}
    {!! Form::hidden('photo',  $data->photo, ['id'=>'image-rountine'] ) !!}
    <div class="form-group">{!! Form::text('name', null , ['placeholder'=>'Name', 'class' => 'form-control floating-label'])!!}</div>
    <div class="form-group">{!! Form::text('lastname', null , ['placeholder'=>'Lastname', 'class' => 'form-control floating-label'])!!}</div>
    <div class="form-group">
      @if($disabled = ['placeholder'=>'Email', 'class' => 'form-control floating-label'])
      @endif
      @if(!empty($data->id))
      @if($disabled['disabled'] = 'disabled')
      @endif
      @endif
      {!! Form::text('email', null , $disabled)!!}
    </div>@if($data->typeregister==2 || empty($data->id))
    <div class="form-group">{!!Form::password('password',array('class'=>'form-control floating-label','placeholder'=>$msgform))!!}</div>@endif
    <div class="form-group">{!! Form::text('age', null , ['placeholder'=>'Age', 'class' => 'form-control floating-label'])!!}</div>
    <div class="form-group">{!! Form::text('location', null , ['placeholder'=>'Location', 'class' => 'form-control floating-label'])!!}</div>
    <div class="form-group">{!! Form::select('gender', $gender, $data->gender, ['class'=>'form-control', 'data-parsley-required'=>'data-parsley-required']) !!}</div>
    <div class="form-group">{!! Form::text('weight', null , ['placeholder'=>'Weight', 'class' => 'form-control floating-label'])!!}</div>
    <div class="form-group">{!! Form::text('height', null , ['placeholder'=>'Height', 'class' => 'form-control floating-label'])!!}</div>
    <div class="form-group">
      <div class="checkbox">{!! sprintf(Form::label('flag_first_time','%s'),Form::checkbox('flag_first_time',1,false)." Complete Registration?") !!}</div>
    </div>
    <div class="form-group">
      <input type="file" requiredfile="requiredfile" data-show-upload="false" name="photo" class="js-uploadInput"/>
      <button type="submit" class="btn btn-primary">SEND</button>
    </div>{!! Form::close() !!}
    @if($errors->any())
    <ul class="alert alert-danger">@foreach($errors->all() as $error)
      <li>{{$error}}</li>@endforeach
    </ul>@endif
  </div>
</div>@stop