@extends('home._layouts.iframe')
@section('css')
<link href="{{ URL::asset('/') }}css/all.css" media="all" rel="stylesheet" type="text/css"/>
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
            <!--<select name="vehicletype" required="required">
                <option value="1">Bicicleta</option>
                <option value="2">Carro</option>
                <option value="3">Moto</option>
            </select>-->
        </div>
    </div>
    <br/>
    <div class="form-control">
        <input type="submit" value="Guardar" class="btn btn--skyblue btn--big"/>
    </div>
</div>
@stop
@section('alpha')
<script>
    window.alpha = {
        module: 'cligo',
        controller: 'comunity',
        action: 'unete'
    }
</script>
@stop
<script src="{{ URL::asset('/') }}js/vendor/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script data-main="{{ URL::asset('/') }}js/main" src="{{ URL::asset('/') }}js/vendor/requirejs/require.js"></script>