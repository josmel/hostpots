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
        
        <div class="personas_perfil">
            <div class="table-responsive-vertical">
               
                <table data-url="{{ action('Client\ProfileController@getList') }}" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Mac</th>
                            <th>Ip</th>
                            <th>Identificador</th>
                            <th>Correo</th>
                            <th>Acción </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="agregar_persona">
                <form data-parsley-validate method="post" action="{{ url('/admclient/perfil/contact') }}" id="formContact">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="">
                    <label>
                        <input type="text" name="name" placeholder="Mac" required>
                    </label>
                    <label>
                        <input type="text" name="cellphone" placeholder="Ip" required data-parsley-type="digits">
                    </label>
                    <label>
                        <input type="text" name="phone" placeholder="Identificador" required data-parsley-type="digits">
                    </label>
                    <button type="submit">+ Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/template" class="row4Table">
    <tr data-id="<%= id %>">
    <td data-title="Nombre">
    <div><%= name %></div>
    </td>
    <td data-title="Celular">
    <div><%= phone %></div>
    </td>
    <td data-title="Teléfono">
    <div><%= cellphone %></div>
    </td>
    <td data-title="Correo">
    <div><%= email %></div>
    </td>
    <td data-title="">
    <div><a href="#" class="edit_contact"><i class="icon icon-lapiz"></i></a><a href="#" data-nom="<%= name %>" data-url="{{ action('Client\ProfileController@getDelete') }}/<%= id %>" class="del_contact"><i class="icon icon-basura"></i></a></div>
    </td>
    </tr>
</script>
@stop