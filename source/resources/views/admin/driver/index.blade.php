@extends('admin._layouts.layout')
@section('title', 'Driver - Listado')
@section('content')
<div id="wrapper" class="container-page">@if(session()->has('messageSuccess'))
  <ul class="alert alert-success">
    <li>{{session('messageSuccess')}}</li>
  </ul>@endif
   <h2>Drivers</h2><a href="/admpanel/driver/form" class="btn btn-success">Nuevo</a>
  <section>
    <table id="categoryTable" data-url="/admpanel/driver/list" data-nofilter="1" data-col="namedriver,lastname,dni,picture,vehicletype,placa_vehicle,driver_state,flagactive,action" class="tables table-striped">
      <thead>
        <tr class="info">
          <td>Nombre</td>
          <td>Apellido</td>
          <td>DNI</td>
           <td>Imagen</td>
          <td>Tipo de Vehículo</td>
          <td>Placa</td>
          <td>Estado de Vehículo</td>
          <td>Estado</td>
          <td class="action">Operaciones</td>
        </tr>
      </thead>
    </table>
  </section>
</div>
<script type="text/template" id="tplEdit" data-initial="/admpanel/driver/list">
        <div class="modal-ctn">
          <form action="#" data-parsley-validate data-url="/dummies/edit.json" data-method="POST" id="editForm">
            <input type="hidden" value="<%= id %>" name="id">
            <header>
              <h1>Editar Registro</h1>
            </header>
            <div class="modal-ctn--form">
              <div class="form-group">
                <input placeholder="Nombre" name="name" value="<%= name %>" data-parsley-required="true" class="form-control floating-label">
              </div>
              <div class="modal-ctn--actions">
                <button type="submit" class="btn btn-primary">Enviar</button>
              </div>
            </div>
          </form>
        </div>
      </script>
      <script type="text/template" id="tplDelete">
        <div class="modal-ctn">
          <form action="#" data-parsley-validate data-url="/admpanel/driver/delete" data-method="GET" id="deleteForm">
            <input type="hidden" value="<%= id %>" name="id">
            <header>
              <h1>Confirmación</h1>
            </header>
            <div class="modal-ctn--form">
              <div class="form-group">
                <h4>¿Desea eliminar este registro?</h4>
              </div>
              <div class="modal-ctn--actions">
                <button type="submit" class="btn btn-primary">Eliminar</button><a href="javascript:;" class="btn btn-danger btn-danger--modal">Cancelar</a>
              </div>
            </div>
          </form>
        </div>
      </script>
@stop
@section('js')
<script src="{{ URL::asset('js/modules/admin/admin.js') }}" type="text/javascript"></script>
@stop
