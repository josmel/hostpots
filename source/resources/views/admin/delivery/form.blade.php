
@extends('admin._layouts.layout')
@section('content')
<div id="wrapper" class="container-page">@if(isset($table->id))
    <h2>Editar estado Delivery</h2>@else
    @endif
    {!! Form::model($table, ['files'=>'true','method'=>'post', 'data-parsley-validate'=>'data-parsley-validate']) !!}
    <div class="form-upload">
        {!! Form::hidden('id',  $table->id ) !!}
        <div class="form-group">
            <label for="">Descripción de Etado</label>
        </div>
        <div class="form-group">{!! Form::select('delivery_state_id', $typeDeliveryState, $table->delivery_state_id, ['class'=>'form-control', 'data-parsley-required'=>'data-parsley-required', 'name' =>'delivery_state_id']) !!}</div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
        {!! Form::close() !!}
        @if($errors->any())
        <ul class="alert alert-danger">@foreach($errors->all() as $error)
            <li>{{$error}}</li>@endforeach
        </ul>@endif
    </div>
</div>

<script type="template/text" id="terms">
    <p>Lorem ipsum dolorem mortem</p>
</script>@stop