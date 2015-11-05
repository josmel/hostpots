@extends('client._layouts.layout')
@section('content')

<div id="wrapper"><br><br><br><br>
    <div class="content_soporte">
        @if(isset($table->id))
        <h2>Editar Campaña</h2>@else
        @endif
        {!! Form::model($table, ['files'=>'true','method'=>'post', 'class'=>'formSoporte row','data-parsley-validate'=>'data-parsley-validate']) !!}
        <div class="columna1">
            <div class="form_control">
                <label>(*) Nombres</label>
                {!! Form::hidden('id',  $table->id ) !!}
                {!! Form::text('name', null , ['placeholder'=>'Nombre','required' => 'required'])!!}
            </div>
        </div>
        <div class="columna2">
            <div class="form_control">
                <label>(*) Descripción</label>
                {!! Form::textarea('description', null , ['class' => 'form-control floating-label','placeholder'=>'','id'=>'wysihtml5-textarea'])!!}
            </div>
        </div>
        <button type="submit">ENVIAR</button>
        {!! Form::close() !!}
        <br><br><br>
    </div>
</div>

@stop