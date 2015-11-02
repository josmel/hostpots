
@extends('admin._layouts.layout')
@section('content')
<div id="wrapper" class="container-page">@if(isset($data->id))
  <h2>Edit of Exercise</h2>@else
  <h2>Register of Exercise</h2>@endif
  {!! Form::model($data, ['files'=>'true','method'=>'post', 'data-parsley-validate'=>'data-parsley-validate', 'url'=>'/admpanel/routine']) !!}
  <div class="form-upload">
    {!! Form::hidden('id',  $data->id ) !!}
    {!! Form::hidden('image',  $data->image, ['id'=>'image-rountine'] ) !!}
    <div class="form-group">{!! Form::text('name', null , ['placeholder'=>'Name', 'name'=>'name', 'class' => 'form-control floating-label'])!!}</div>
    <div class="form-group">{!! Form::select('type_runtime_id', $typeroutine, $data->type_runtime_id, ['class'=>'form-control', 'data-parsley-required'=>'data-parsley-required', 'name' =>'type_runtime_id']) !!}</div>
    <div class="form-group">
      <input type="file" requiredfile="requiredfile" data-show-upload="false" name="image" class="js-uploadInput"/>
      <button type="submit" class="btn btn-primary">Enviar</button>
    </div>{!! Form::close() !!}
  </div>
</div>
<script type="template/text" id="terms">
  <p>Lorem ipsum dolorem mortem</p>
</script>@stop