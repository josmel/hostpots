@extends('home._layouts.iframe')
@section('css')
<link href="{{ URL::asset('/') }}css/all.css" media="all" rel="stylesheet" type="text/css"/>
<style>#reserva .programa .content_day{padding-top:25px;text-align:center;border:1px solid #ccc;padding-bottom:25px}#reserva .programa input{padding:5px 0;text-align:left;margin-left:5px;padding-left:22px;color:#999}#paso2 .container,#paso3 .container{max-width:820px;margin:0 auto;position:relative;padding-top:35px;}#paso2 .container form,#paso3 .container form{position:relative;width:49%;margin-right:20px;display:inline-block;vertical-align:top;}
    .box_helper {
        background-color:rgba(72, 192, 247, 0.780392);
        color:#FFFFFF;
        padding:10px;
        position:relative;
    }</style>
@stop
@section('content')
<div class="text-center join_unete main_unete">
    {!! Form::open(array('data-mcs-theme'=>'dark','class'=>'form-ctn-joinus mCustomScrollbar form_unete', 'role'=>'form','data-parsley-validate')) !!}
    <div class="form-control">
        <h4>MIS CAMPAÑAS</h4>
        <div class="form-select">
             {!! Form::hidden('groups_id',  $idGroups ) !!}
            {!! Form::hidden('id',  $table->id ) !!}
                {!! Form::select('campania_id', $typeCampania, $table->campania_id, ['class'=>'combo_personal', 'data-parsley-required'=>'data-parsley-required', 'name' =>'campania_id']) !!}        </li>
        </div>
    </div>
      <div class="form-control">
             <legend>Repetir</legend>
        <div class="show_frecuencia">
            <div class="columna1">
                <div class="box_helper">
                    <p>Si eliges Repetir, tu campaña se quedará agendado y se repetirá automáticamente en las fechas que escojas.</p>
                </div>
            </div><br><br>
            <div class="content_day">
                <?php // dd($table->day_id);  ?>
                @foreach($day as $item) 
                    <?php $checked = in_array($item->id, (array)$table->day_id); ?>
                <div class="form-check">
                    <label>{{ $item->name }}</label>
                    {!! Form::checkbox('day_id[]',$item->id, $checked)!!}
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <br/>
    <div class="form-control">
        <input type="submit" value="Guardar" class="btn btn--skyblue btn--big"/>
    </div>
</div>
@stop
@section('alpha')
@stop
<script src="{{ URL::asset('/') }}js/vendor/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script data-main="{{ URL::asset('/') }}js/main" src="{{ URL::asset('/') }}js/vendor/requirejs/require.js"></script>