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
        <div class="texto_perfil">
            <ul>
                <li style="
                    color: #48c0f7;
                    font-size: 1.53em;
                    ">
                     GRUPOS
                </li>
            </ul>
        </div>
        <div class="personas_perfil">
            <div class="table-responsive-vertical">
                <table data-url="/admclient/groups/list-groups" class="table table-hover">
                <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Cliente </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="agregar_persona">
                 <form data-parsley-validate method="post" action="{{ url('/admclient/user/groups') }}" id="formContact">
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
<script type="text/template" class="row4Table">
    <tr data-id="<%= id %>">
    <td data-title="ID">
    <div><%= id %></div>
    </td>
    <td data-title="Nombre">
    <div><%= name %></div>
    </td>
    <td data-title="FA">
    <div><%= flagactive %></div>
    </td>
    <td data-title="Cliente">
    <div><%= cliente %></div>
    </td>
        </tr>
</script>
@stop

