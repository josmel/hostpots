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
    <div class="container_perfl">
        <div class="agregar_persona">
            <a href="/admclient/admin/form" >
                <button style="background: #48c0f7 none repeat scroll 0 0;
                        border: medium none;
                        color: #fff;
                        cursor: pointer;
                        padding: 10px;"type="submit">+ Agregar Administrador</button></a><br><br>
        </div>
        <div class="personas_perfil">
          <div class="table-responsive-vertical">
                <table data-url="/admclient/admin/list" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Acción </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/template" class="row4Table">
    <tr data-id="<%= id %>">
                <td data-title="ID">
    <div><%= id %></div>
    </td>
    
    <td data-title="Nombre">
    <div><%= name_customer %></div>
    </td>
    <td data-title="Email">
    <div><%= email %></div>
    </td>
    <td data-title="">
    <div>
                <a href="/admclient/admin/form/<%= id %>" class=""><i class="icon icon-lapiz"></i></a>
                <a href="#" data-nom="<%= name %>" data-url="{{ action('Client\AdminController@getDelete') }}/<%= id %>" class="del_contact"><i class="icon icon-basura"></i></a></div>
    </td>
    </tr>
</script>
@stop