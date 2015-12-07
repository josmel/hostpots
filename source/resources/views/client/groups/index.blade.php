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
                    MIS GRUPOS
                </li>
            </ul>
        </div>
        <div class="personas_perfil">
            <div class="table-responsive-vertical">
                <table id="categoryTable" data-url="/admclient/groups-data" data-nofilter="1" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Equipos</th>
                            <th>Estado</th>
                            <th>Acción </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="agregar_persona">
                <form data-parsley-validate method="post" action="{{ url('/admclient/groups/groups') }}" id="formContact">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="id" value="">
                    <label>
                        <input type="text" name="name" placeholder="Nombre" required>
                    </label>
                    <button type="submit">+ Agregar Grupo</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/template" id="addTagsExercise">
  <div style="width:600px;" class="ctn-addTags">
    <h2>Agregar Equipo</h2>
    <form>
      <div class="form-ctn">
        <div class="input-ctn">
          <input type="hidden" value="<%= idroutine %>" class="idrout"/>
          <select name="tags" multiple="multiple" style="width:250px" class="multiselect-custom"><%= options %></select>
        </div><a href="javascript:;" class="btn btn-raised btn-info btn- btn-save">Agregar</a><a href="javascript:;" class="btn btn-raised btn-danger btn-cancel">Cancelar</a>
      </div>
    </form>
  </div>
</script>
<script type="text/template" class="row4Table">
    <tr data-id="<%= id %>">
    <td data-title="ID">
    <div><%= id %></div>
    </td>
    <td data-title="Nombre">
    <div><%= name %></div>
    </td>
 <td data-title="Equipos">
    <div><%= hotspots %></div>
    </td>
    <td data-title="FA">
    <div><%= flagactive %></div>
    </td>
    <td data-title="">
    <div>
    <a title="Configuracion de Campaña" class="fancybox fancybox.iframe" href="/admclient/groups/configuracion/<%= id %>" ><i class="icon icon-recibo"></i></a>
    <a href="#" class="edit_contact"><i class="icon icon-lapiz"></i></a>
    <a href="#" data-nom="<%= name %>" data-url="{{ action('Client\GroupsController@getDelete') }}/<%= id %>" class="del_contact"><i class="icon icon-basura"></i></a></div>
    </td>
    </tr>
</script>
@stop
<!-- <a href="/admclient/equipment/index/<%= id %>" title="Agregar Equipos" class=""><i class="icon icon-soporte_off i-soporte"></i></a>
   -->

