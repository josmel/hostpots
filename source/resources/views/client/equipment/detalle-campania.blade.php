@extends('client._layouts.layout')
@section('content')
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script><style>.col{float:left;margin:5px;padding:5px;}
    #col1{width:200px;height:auto;border:1px solid black;}
    img.drag{width:40px;height:40px;position:relative;}
    #droppable{width:80px;height:80px;border:1px solid black;}
    .right{float:right;}
    .left{float:left;}
    .clear{clear:both;}
    ul li{list-style:none;}
    .drag-list img{width:80px;vertical-align:middle;cursor:move;}
    .drag-list ul{margin:0;padding:0;}
    .drag-list li{margin-bottom:5px;}
    .remove-drag-hover{background-color:#ED4949!important;}
    .drop-area{background-color:#afd1b2;}
    .xicon{margin-top:4px;position:absolute;margin-left:-17px;color:#FFF;font:message-box;text-decoration:none;}
    .xicon:hover{background-color:#fff;color:#000;width:13px;height:20px;text-align:center;}
    .tip{font-size:12px;clear:both;}</style>

<div id="wrapper">
    <div class="col" id="col1">
        <div id="drag-list" class="drag-list">
            <ul>
                <li><span id="drag1" class="drag">
                        <img src="http://placehold.it/80x80/c9112d/fff&text=1" width="100%" height="100%" />
                    </span><span>Item 1</span> 
                </li>
                <li><span id="drag2" class="drag">
                        <img src="http://placehold.it/80x80/E68500/fff&text=2" width="100%" height="100%" />
                    </span><span>Item 2</span> 
                </li>
                <li><span id="drag3" class="drag">
                        <img src="http://placehold.it/80x80/00810C/fff&text=3" width="100%" height="100%" />
                    </span><span>Item 3</span> 
                </li>
            </ul>
        </div>
    </div>
    <div class="col" id="droppable"></div>

</div>
<script>
    var x = null;
//Make element draggable
    $(".drag").draggable({
        helper: 'clone',
        cursor: 'move',
        tolerance: 'fit',
        revert: true
    });

    $("#droppable").droppable({
        accept: '.drag',
        activeClass: "drop-area",
        drop: function (e, ui) {
            if ($(ui.draggable)[0].id != "") {


                x = ui.helper.clone();
                ui.helper.remove();
                x.draggable({
                    helper: 'original',
                    cursor: 'move',
                    //containment: '#droppable',
                    tolerance: 'fit',
                    drop: function (event, ui) {
                        $(ui.draggable).remove();
                    }
                });

                x.resizable({
                    maxHeight: $('#droppable').height(),
                    maxWidth: $('#droppable').width()
                });
                x.addClass('remove');
                var el = $("<span><a href='Javascript:void(0)' class=\"xicon delete\" title=\"Remove\">X</a></span>");
                $(el).insertAfter($(x.find('img')));
                x.appendTo('#droppable');
                $('.delete').on('click', function () {
                    $(this).parent().parent('span').remove();
                });
                $('.delete').parent().parent('span').dblclick(function () {
                    $(this).remove();
                });
            }
        }
    });

    $("#remove-drag").droppable({
        drop: function (event, ui) {
            $(ui.draggable).remove();
        },
        hoverClass: "remove-drag-hover",
        accept: '.remove'
    });</script>
@stop