@extends('client._layouts.layout')
@section('content')
<link href="http://plugins.krajee.com/assets/bb478bee/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<div id="wrapper"><br><br><br><br>

    <div class="content_soporte">
        {!!Form::model($table,array('class'=>'formSoporte row','role'=>'form','files'=>'true','data-parsley-validate'))!!}
        {!! Form::hidden('id',  $table->id ) !!}
        {!! Form::hidden('imagen',  $table->imagen, ['id'=>'image-rountine'] ) !!}
        <!--<form data-parsley-validate class="formSoporte row">-->

        <div class="columna1">
            <div class="form_control">
                <label>(*) Nombre de Campaña</label>
                {!! Form::text('name',old('name'),array('required','id'=>'name')) !!}
            </div>
            <div class="form_control">
                <label>(*) Megas</label>
                {!! Form::text('megas',old('megas'),array('required','id'=>'megas')) !!}
              <!--<input type="text" name="email" required data-parsley-type="email">-->
            </div>
           
        </div>
        <div class="columna2">
            <div class="form_control">
                <label>Url de redirección</label>
                {!! Form::text('url',old('url'),array('required','id'=>'url')) !!}
            </div>
            <div class="form_control">
                <label>Expiracion</label>
                {!! Form::text('expiracion',old('expiracion'),array('required','id'=>'expiracion')) !!}
            </div>
        </div>
         <div class="form_control">
                <!--<label>Imagen de Campaña</label>-->
                <!--<input type="file" class="form-control" name="imagen" >-->
                <label class="control-label">Select File</label>
                <input id="input-1" type="file" class="file" name="imagen">
                <!--{!! Form::text('imagen',old('imagen'),array('required','id'=>'imagen')) !!}-->
                  <!--<input type="file" id="uploadImgOne" data-hidden-id="#image-rountine" data-show-upload="false" data-allowed="jpg,png,gif" name="imagen" data-format="image"  class="js-uploadInput"/>-->
              <!--<input type="text" name="email" required data-parsley-type="email">-->
            </div>
        {!! Form::button('Save', array( 'type'=>'submit')) !!}
        <!--<button type="submit">Guardar</button>-->
        {!!Form::close()!!}@if($errors->any())
        <ul class="alert alert-danger">@foreach($errors->all() as $error)
            <li>{{$error}}</li>@endforeach
        </ul>@endif<br><br><br>
    </div>
</div>
@stop