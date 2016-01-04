@extends('client._layouts.layout')
@section('content')
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<style>
    @media all and (max-width: 800px){
        #contenedor .bloque{
            display: block !important;  /* Cuando el ancho sea inferior a 800px el elemento será un bloque */
            width: auto !important;
        }
    }
    @media all and (max-width: 800px){
        #items .item{
            display: block !important;  /* Cuando el ancho sea inferior a 800px el elemento será un bloque */
            width: auto !important;
        }
    }
    #contenedor .bloque{
        background: #778899 ;
        background-repeat: no-repeat;
        background-size: 100% 100%;
        display: inline-block;  /* Es esencial para que se muestren los bloques en línea */
        height:110px;
        width: 110px;
        color: white;
        size: 0.7em;
        margin:20px;
    }

    #contenedor .bloque p{

        color: white;
        font-size: 1.3em;
        margin:35px;
    }


    #items .item{
        background: #778899 ;
        background-repeat: no-repeat;
        background-size: 100% 100%;
        display: inline-block;  /* Es esencial para que se muestren los bloques en línea */
        height:110px;
        width: 110px;
        color: white;
        size: 0.7em;
        margin:20px;
    }
    #items .item p{
        color: #FF4500;
        font-size: 0.8em;
        margin:35px;
    }
    #contenedor .item {

        background-repeat: no-repeat;
        background-size: 100% 100%;
        width: 100%;
        height: 100%; }

</style>
<script>
    //<![CDATA[
    $(window).load(function () {
        //all occurs within .ready
        (function ($, undefined) {
            // set up background images
            $('.item').each(function (i, o) {
                $(o).css('background-image', 'url(' + $(o).data('src') + ')');
            });

            $('.item').draggable({
                cancel: "a.ui-icon", // clicking an icon won't initiate dragging
                //revert: "invalid", // when not dropped, the item will revert back to its initial position
                revert: true, // bounce back when dropped
                helper: "clone", // create "copy" with original properties, but not a true clone
                cursor: "move"
                , revertDuration: 0 // immediate snap
            });

            $('.bloque').droppable({
                accept: "#items .item",
                activeClass: "ui-state-highlight",
                drop: function (event, ui) {
                    var dataCampania = $.ajax({
                        url: '/admclient/equipment/hotspots-setting',
                        type: 'get',
                        data: {hotspots_id: <?=$idEquipment ?>,
                            campania_id: ui.draggable.context.id,
                            day_id: $(this).context.id
                        },
                        dataType: 'json',
                        async: false
                    }).responseText;
                    dataCampania = JSON.parse(dataCampania);
                    var numbers = Array.prototype.slice.call(dataCampania.data);

                    // clone item to retain in original "list"
                    var $item = ui.draggable.clone();

                    $(this).addClass('has-drop').html($item);

                }
            });
        })(jQuery);
    });//]]>
</script>
<div id="wrapper">
    <div class="container_perfl">
        <div class="texto_perfil">
            <ul>
                <li class="input_form">{!! Form::button('CAMPAÑAS',array('type'=>'submit')) !!}</li>
            </ul>
        </div>
        <div id="items">
            @foreach ($dataCampania as $campania)
            <div id="{{ $campania['id']}}" class="item" data-src="{{ $campania['imagen'] }}">  <span>{{ $campania['name'] }}</span> </div>
            @endforeach
        </div>
        <div class="texto_perfil">
            <ul>
                <li class="input_form">{!! Form::button('DIAS',array('type'=>'submit')) !!}</li>
            </ul>
        </div>
        <div id="contenedor">
            @foreach ($day as $key=>$d)
            <div id="{{ $d->id}}" class="bloque" >
                @if (isset($d->campania_id))
                <div id="{{ $d->campania_id }}" class="item ui-draggable" data-src="{{$d->campania_imagen }}" style="background-image: url('{{$d->campania_imagen }}');">
                    <span>{{ $d->campania_name }}</span>  </div>
                @else
                <p>{{ $d->name}}</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>     
</div>
@stop


