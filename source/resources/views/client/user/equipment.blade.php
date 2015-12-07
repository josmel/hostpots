@extends('client._layouts.layout')
@section('content')
<script type="text/javascript" src="{{ asset('client/') }}/css/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('client/') }}/css/source/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type='text/javascript'>try{jQuery.noConflict();}catch(e){};</script>
<script type="text/javascript">
var $= jQuery.noConflict();
$(document).ready(function () {

    /*
     *  Simple image gallery. Uses default settings
     */

    $('.fancybox').fancybox();


    $("#fancybox-manual-b").click(function () {
        $.fancybox.open({
            href: '.html',
            type: 'iframe',
            padding: 5
        });
    });


});
</script>
<style type="text/css">
    .fancybox-custom .fancybox-skin {
        box-shadow: 0 0 50px #222;
    }


</style>
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
                    EQUIPOS
                </li>
            </ul>
        </div>
        <div class="personas_perfil">
            <div class="table-responsive-vertical">
                <table data-url="/admclient/equipment/list?user={{ $idUser}}" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Mac</th>
                            <th>Ip</th>
                            <th>Identificador</th>
                              <th>Descripcion</th>
                            <th>Acción </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="agregar_persona">
                <form data-parsley-validate method="post" action="{{ url('/admclient/equipment/contact') }}" id="formContact">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="customer_id" value="{{ $idUser}}">
                    <label>
                        <input type="text" name="mac" placeholder="Mac" required>
                    </label>
                    <label>
                        <input type="text" name="owner" placeholder="Ip" >
                    </label>
                    <label>
                        <input type="text" name="name" placeholder="Identificador" required>
                    </label>
                    <label>
                        <input type="text" name="email_owner" placeholder="Descripcion" required>
                    </label>
                    <button type="submit">+ Agregar Equipo</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/template" class="row4Table">
    <tr data-id="<%= id %>">
    <td data-title="Mac">
    <div><%= mac %></div>
    </td>

    <td data-title="Ip">
    <div><%= owner %></div>
    </td>
   <td data-title="Identificador">
    <div><%= name %> </div>
    </td>
    <td data-title="Descripcion">
    <div><%= email_owner %> </div>
    </td>
        <td data-title="">
            <div>
              <a title="Configurar campaña individual" class="fancybox fancybox.iframe" href="/admclient/equipment/configuracion/<%= id %>/{{ $idUser}}" ><i class="icon icon-recibo"></i></a>

            <a href="#" class="edit_contact"><i class="icon icon-lapiz"></i></a>
            <a href="#" data-nom="<%= name %>" data-url="{{ action('Client\EquipmentController@getDelete') }}/<%= id %>" class="del_contact">
            <i class="icon icon-basura"></i></a>
             </div>
        </td>
    </tr>
</script>
@stop
