@extends('client._layouts.layout')
@section('content')
<script type="text/javascript" src="{{ asset('client/') }}/css/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('client/') }}/css/source/jquery.fancybox.css?v=2.1.5" media="screen" />
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
        <div class="agregar_persona">
            <a href="/admclient/user/formcampania/{{$idUser}}" >
                <button style="background: #48c0f7 none repeat scroll 0 0;
                        border: medium none;
                        color: #fff;
                        cursor: pointer;
                        padding: 10px;"type="submit">+ Agregar Campaña</button></a> 
            <span class="more-exercise" data-exercises=",0"> + </span>
            <br><br>
        </div>
        <div class="personas_perfil">
            <div class="table-responsive-vertical">
                <table id="categoryTable" data-url="/admclient/campanias/list?idCustomer={{$idUser}}" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Publicidad</th>
                            <th>Acción </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script type="text/template" id="addTagsExercise">
  <div style="width:100%" class="ctn-addTags">
    <h2>Agregar Campañas Libres</h2>
    <form>
      <div class="form-ctn">
        <div class="input-ctn">
          <input type="hidden" value="{{$idUser}}" class="idCustomer"/>
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
    <td data-title="name">
    <div><%= name %></div>
    </td>
    <td data-title="Imagen">
    <div><%= imagen %></div>
    </td>
    <td data-title="">
    <div><a href="/admclient/user/formcampania/{{$idUser}}-<%= id %>" class=""><i class="icon icon-lapiz"></i></a><a href="#" data-nom="<%= name %>" data-url="{{ action('Client\CampaniasController@getDelete') }}/<%= id %>/{{$idUser}}" class="del_contact"><i class="icon icon-basura"></i></a></div>
    </td>
    </tr>
</script>
@stop