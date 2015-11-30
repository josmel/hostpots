@extends('client._layouts.layout')
@section('content')
<div id="wrapper">@if(session()->has('messageSuccess'))
    <ul role="alert" class="alert alert-success alert-dismissible">
        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true">&times;</span></button>
        <li>{{session('messageSuccess')}}</li>
    </ul>@endif
    @if (count($errors) > 0)
    <div class="alert alert-danger">Errores:<br>
        <ul>@foreach ($errors->all() as $error)
            <li>{{ $error }}</li>@endforeach
        </ul><br>
    </div>@endif
    <div class="container_perfl">
        {!! Form::model($table,array('id'=>'form_perfil','data-parsley-validate')) !!}
        <div class="texto_perfil">
            <ul>
                <li>
                     {!! Form::label(null,'Campaña') !!}
                    {!! Form::hidden('id',  $table->id ) !!}
                </li>
                <li><span>Nombre de la Campaña</span><br>{!! Form::text('name',old('name'),array('required','id'=>'name')) !!}</li>
                <li class="input_form">{!! Form::button('Actualizar',array('type'=>'submit')) !!}</li>
            </ul>
        </div>
        <div class="map_perfil"><span>Cuerpo de la Campaña</span><br><br>
            <div class="form_control">
                {!! Form::textarea('description', null , ['class' => 'form-control floating-label','placeholder'=>'','id'=>'wysihtml5-textarea'])!!}
            </div>
        </div>
        {!! Form::close() !!}	
    </div>
</div>
@stop