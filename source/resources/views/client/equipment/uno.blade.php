











@extends('client._layouts.layout')
@section('content')

<style>


    /* Header/footer boxes */

    .wideBox {
        clear: both;
        text-align: center;
        margin: 70px;
        padding: 10px;
        background: #ebedf2;
        border: 1px solid #333;
    }

    .wideBox h1 {
        font-weight: bold;
        margin: 20px;
        color: #666;
        font-size: 1.5em;
    }
    .img{
        width: 100%;
        height: 100%;
    }
    /* Slots for final card positions */

    #cardSlots {
        margin: 50px auto 0 auto;
        background: #ddf;
    }

    /* The initial pile of unsorted cards */

    #cardPile {
        margin: 0 auto;
        background: #ffd;
    }

    #cardSlots, #cardPile {
        width: 910px;
        height: 120px;
        padding: 20px;
        border: 2px solid #333;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        -moz-box-shadow: 0 0 .3em rgba(0, 0, 0, .8);
        -webkit-box-shadow: 0 0 .3em rgba(0, 0, 0, .8);
        box-shadow: 0 0 .3em rgba(0, 0, 0, .8);
    }

    /* Individual cards and slots */

    #cardSlots div, #cardPile div {
        float: left;
        width: 80px;
        height: 78px;
        /*  padding: 10px;
          padding-top: 40px;*/
        padding-bottom: 0;
        border: 2px solid #333;
        /*  -moz-border-radius: 10px;
          -webkit-border-radius: 10px;*/
        /*border-radius: 10px;*/
        margin: 0 0 0 10px;
        background: #fff;
    }

    #cardSlots div:first-child, #cardPile div:first-child {
        margin-left: 0;
    }

    #cardSlots div.hovered {
        background: #aaa;
    }

    #cardSlots div {
        border-style: dashed;
    }

    #cardPile div {
        background: #666;
        /*color: #fff;*/
        /*font-size: 50px;*/
        text-shadow: 0 0 3px #000;
    }

    #cardPile div.ui-draggable-dragging {
        -moz-box-shadow: 0 0 .5em rgba(0, 0, 0, .8);
        -webkit-box-shadow: 0 0 .5em rgba(0, 0, 0, .8);
        box-shadow: 0 0 .5em rgba(0, 0, 0, .8);
    }



    /* "You did it!" message */
    #successMessage {
        position: absolute;
        left: 580px;
        top: 250px;
        width: 0;
        height: 0;
        z-index: 100;
        background: #dfd;
        border: 2px solid #333;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        -moz-box-shadow: .3em .3em .5em rgba(0, 0, 0, .8);
        -webkit-box-shadow: .3em .3em .5em rgba(0, 0, 0, .8);
        box-shadow: .3em .3em .5em rgba(0, 0, 0, .8);
        padding: 20px;
    }


</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
<script type="text/javascript">

    var correctCards = 0;
    $(init);

    function init() {

        // Hide the success message
        $('#successMessage').hide();
        $('#successMessage').css({
            left: '580px',
            top: '250px',
            width: 0,
            height: 0
        });

        // Reset the game
        correctCards = 0;
        $('#cardPile').html('');
        $('#cardSlots').html('');

        // Create the pile of shuffled cards
        var dataCampania = $.ajax({
            url: '/admclient/campanias/campanias-for-user',
            type: 'get',
            dataType: 'json',
            async: false
        }).responseText;
        dataCampania = JSON.parse(dataCampania);
        var numbers = Array.prototype.slice.call(dataCampania.data);
//  numbers.sort( function() { return Math.random() - .5 } );

        for (var i = 0; i < numbers.length; i++) {
            $('<div><img class="img" src=' + numbers[i]['imagen'] + '/>' + numbers[i]['name'] + '</div>').data('number', numbers[i]['id']).attr('id', numbers[i]['id']).appendTo('#cardPile').draggable({
                cancel: "a.ui-icon",
                stack: '#cardPile div',
                cursor: 'move',
                revert: true,
                tolerance: "fit",
                helper: "clone"
                , revertDuration: 0 // immediate snap
            });
        }

        // Create the card slots
        var words = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
        for (var i = 1; i <= 7; i++) {
            $('<div>' + words[i - 1] + '</div>').data('number', i).appendTo('#cardSlots').droppable({
                accept: '#cardPile div',
                hoverClass: 'hovered',
                drop: handleCardDrop
            });
        }

    }


    function handleCardDrop(event, ui) {
        if ($(ui.draggable)[0].id != "") {
            var slotNumber = $(this).data('number');

            var cardNumber = ui.draggable.data('number');
            // If the card was dropped to the correct slot,
            // change the card colour, position it directly
            // on top of the slot, and prevent it being dragged
            // again
            var $item = ui.draggable.clone();
            $(this).addClass('correct').html($item);
//  if ( slotNumber == cardNumber ) {
        ui.draggable.addClass('ui_dragable');
//        ui.draggable.draggable('disable');
//        $(this).droppable('disable');
//
//        ui.draggable.position({of: $(this), my: 'left top', at: 'left top'});
//        ui.draggable.draggable('option', 'revert', false);
//        correctCards++;

//  } 
        }
        // If all the cards have been placed correctly then display a message
        // and reset the cards for another go

        if (correctCards == 7) {
            $('#successMessage').show();
            $('#successMessage').animate({
                left: '380px',
                top: '200px',
                width: '400px',
                height: '100px',
                opacity: 1
            });
        }

    }

</script>


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
        <div class="texto_perfil">
            <ul>
                <li style="
                    color: #48c0f7;
                    font-size: 1.53em;
                    ">
                    MIS CAMPAÑAS
                </li>
            </ul>
        </div>
        <div id="cardPile"> </div>
        <br><br><br><br><br>
        <div class="texto_perfil">
            <ul>
                <li style="
                    color: #48c0f7;
                    font-size: 1.53em;
                    ">
                    SELECCIONAR  DIAS
                </li>
            </ul>
        </div>
        <div id="cardSlots"> </div>

        <div id="successMessage">
            <h2>Semana Configurada!</h2>
            <button onclick="init()">Play Again</button>
        </div>
    </div>
</div>


@stop
