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
            <a href="/admclient/user/formcampania" >
                <button style="background: #48c0f7 none repeat scroll 0 0;
                        border: medium none;
                        color: #fff;
                        cursor: pointer;
                        padding: 10px;"type="submit">+ Agregar Campaña</button></a><br><br>
        </div>
        <div class="personas_perfil">
            <div class="table-responsive-vertical">
                <table data-url="/admclient/campanias/list?idCustomer=0" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Publicidad</th>
                            <th>Cliente </th>
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
    <td data-title="name">
    <div><%= name %></div>
    </td>
    <td data-title="Imagen">
    <div><%= imagen %></div>
    </td>
    <td data-title="Customer">
    <div><%= cliente %></div>
    </td>
    </tr>
</script>
@stop