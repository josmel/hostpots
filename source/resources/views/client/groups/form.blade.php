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
        <div class="texto_perfil">{!! Form::model($table,array('id'=>'form_perfil','data-parsley-validate')) !!}
            <ul>
                <li>
                    {!! Form::label(null,'CLIENTE') !!}
                    {!! Form::hidden('latitude') !!}
                    {!! Form::hidden('longitude') !!}<br><br>
                    {!! Form::hidden('id',$id) !!}
                </li>
                <li class="input_form"><span>Nombre de la empresa</span><br>{!! Form::text('name_customer',old('name_customer'),array('required')) !!}</li>
                <li class="input_form"><span>Email</span><br>{!! Form::text('email',old('email'),array('required','data-parsley-type'=>'email')) !!}</li>
                <li class="input_form mt13"><span>RUC</span><br>{!! Form::text('ruc',old('ruc'),array('required','data-parsley-maxlength'=>'11')) !!}</li>
                <li class="input_form"><span>Contraseña (Dejar en blanco, para mantener la misma contraseña)</span><br>{!! Form::password('password') !!}</li>
                <li>
                    <div></div>
                </li>
                <li><span>Dirección (Ej. Calle Mozart 456, San Borja)</span><br>{!! Form::text('address',old('address'),array('required','id'=>'dir_perfil')) !!}</li>
                <li><span>Referencia</span><br>{!! Form::text('referencia',old('referencia'),array('required')) !!}</li>
                <li class="input_form">{!! Form::button('Actualizar',array('type'=>'submit')) !!}</li>
            </ul>{!! Form::close() !!}	
        </div>
        <div class="map_perfil"><span>Marcar la dirección exacta en el mapa</span><br><br>
            <div id="map_perfil" data-lat="{{$table->latitude}}" data-lng="{{$table->longitude}}" class="google-map"></div>
        </div>

        <div class="texto_perfil">{!! Form::model($table,array('id'=>'form_perfil','data-parsley-validate')) !!}
            <ul>
                <li style="
                    color: #48c0f7;
                    font-size: 1.223em;
                    ">
                    {!! Form::label(null,'GRUPOS') !!}
                </li>
            </ul>
        </div>
        <div class="personas_perfil"> <div class="personas_perfil">
                <div class="table-responsive-vertical">
                    <table data-url="/admclient/user/list-groups?idCustomer={{$id}}" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Fecha de Creación</th>
                                <th>Acción </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="agregar_persona">
                    <form data-parsley-validate method="post" action="{{ url('/admclient/user/groups') }}" id="formContact">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="customer_id" value="{{$id}}">
                        <input type="hidden" name="id" value="">
                        <label>
                            <input type="text" name="name" placeholder="Nombre" required>
                        </label>
                        <button type="submit">+ Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/template" class="row4Table">
        <tr data-id="<%= id %>">
        <td data-title="id">
        <div><%= id %></div>
        </td>
        <td data-title="name">
        <div><%= name %></div>
        </td>
        <td data-title="datecreate">
        <div><%= datecreate %></div>
        </td>
        <td data-title="">
        <div>
        <a href="/admclient/user/equipment/<%= id %>" title="Agregar Equipos" class=""><i class="icon icon-recibo"></i></a>
        <a href="#" class="edit_contact"><i class="icon icon-lapiz"></i></a>
        <a href="#" data-nom="<%= name %>" data-url="{{ action('Client\UserController@getDeleteEquipment') }}/<%= id %>" class="del_contact"><i class="icon icon-basura"></i></a></div>
        </td>
        </tr>
    </script>
    @stop