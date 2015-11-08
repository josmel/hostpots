


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
    <div id="reserva" class="container_pasos">
        <div class="container"><div class="container"></div></div>
        <div class="container">{!! Form::open(array('id'=>'formreserva','data-parsley-validate')) !!}
            <legend>Campaña</legend>
            <div class="programa">
                <div class="content_date">
                    <div class="contene">
                        {!! Form::select('campania_id', $typeCampania, $table->campania_id, ['class'=>'combo_personal', 'data-parsley-required'=>'data-parsley-required', 'name' =>'campania_id']) !!}        </li>
                    </div>
                        {!! Form::hidden('id',  $table->id ) !!}
                        {!! Form::hidden('equipment_id',  $equipment_id ) !!}
                    <div class="content_date"><br>
                        <legend>Reserva</legend><br>
                        <label> <span>Desde</span><i class="icon icon-calendar"></i>
                            <input type="text" name="datestart" id="datetimepicker1">
                        </label>
                        <label> <span>Hasta</span><i class="icon icon-calendar"></i>
                            <input type="text" name="datefinal" id="datetimepicker2">
                        </label>
                    </div>
                    <br><br>
                    <div class="show_frecuencia">
                        <legend>Repetir</legend>
                        <div class="columna1">
                            <div class="box_helper"><span>x</span>
                                <p>Si eliges Repetir, tu campaña se quedará agendado y se repetirá automáticamente en las fechas y horas que escojas.</p>
                            </div>
                        </div><br><br>
                        <div class="content_day">
                            @foreach($day as $item)
                            <div class="form-check">
                                <label>{{ $item->name }}</label>
                                {!! Form::checkbox('day_id[]',$item->id, true, ['class'=>'check_day'] )!!}
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>  
               
                        <div class="operacion_pasos">
      <button style="background: #48c0f7 none repeat scroll 0 0;
                        border: medium none;
                        color: #fff;
                        cursor: pointer;
                        padding: 10px;" type="submit" name="SUBMIT"  id="btn_reserva" class="btn">Enviar</button>
    </div>
            
<!--                      <div class="operacion_pasos">
      <button type="submit" name="SUBMIT" onclick="this.disabled='disabled';this.form.submit();" id="btn_reserva" class="btn">Enviar</button>
    </div>-->
            
            {!! Form::close() !!}
                

              
        </div>
    </div>
</div>
@stop