@extends('admin._layouts.layout')
@section('title', 'Region - Listado')
@section('content')
<div id="wrapper" class="container-page">@if(session()->has('messageSuccess'))
  <ul class="alert alert-success">
    <li>{{session('messageSuccess')}}</li>
  </ul>@endif
  <h2>Delivery</h2>
  <section>
    <label for="cbo-filter">Filtrar:</label>
    <input type="text" class="js-date-filter" placeholder="Desde" readonly>
    <input type="text" class="js-date-filter2" placeholder="Hasta" readonly>
    <a href="javascript:;" class="btn-filter">Link</a>
    <table id="categoryTable" data-url="/admpanel/delivery/list" data-nofilter="1" data-col="code,datestart,vehicletype,paymenttype,category,nameCustomer,number_points,price,delivery_type,delivery_state,action" class="tables table-striped">
      <thead>
        <tr class="info">
          <td>Código</td>
          <td >Fecha Inicio</td>
          <td>Tipo de Vehículo</td>
          <td>Medio de pago</td>
          <td>Categoría</td>
          <td>Cliente</td>
          <!--<td>Conductor</td>-->
          <td>Puntos</td>
          <td>Precio</td>
          <td>Tipo de Delivery</td>
          <td>Estado</td>
          <td class="action">Operaciones</td>
        </tr>
      </thead>
    </table>
  </section>
</div>
<script type="text/template" id="tplEdit" data-initial="/admpanel/delivery/list">
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
          <form action="#" data-parsley-validate data-url="/admpanel/delivery/delete" data-method="GET" id="deleteForm">
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
