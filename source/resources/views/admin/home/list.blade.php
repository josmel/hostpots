
@extends('admin._layouts.layout')
@section('content')
<div id="wrapper" class="container-page">
  <h2>Routines</h2><a href="/admpanel/routine" class="btn btn-success">Nuevo</a>
  <section>
    <table id="categoryTable" data-url="/admpanel/routine-data" data-nofilter="1" data-col="name,exercise,image,action" class="tables table-striped">
      <thead>
        <tr class="info">
          <td>Name</td>
          <td>Exercise</td>
          <td>Image</td>
          <td class="action"></td>
        </tr>
      </thead>
    </table>
  </section>
</div>
<script type="text/template" id="tplEdit" data-initial="/dummies/edituser.json">
  <div class="modal-ctn">
    <form action="#" data-parsley-validate="data-parsley-validate" data-url="/dummies/edit.json" data-method="POST" id="editForm">
      <input type="hidden" value="<%= id %>" name="id"/>
      <header>
        <h1>Editar Registro</h1>
      </header>
      <div class="modal-ctn--form">
        <div class="form-group">
          <input placeholder="Nombre" name="name" value="<%= name %>" data-parsley-required="true" class="form-control floating-label"/>
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
    <form action="#" data-parsley-validate="data-parsley-validate" data-url="delete-routine" data-method="POST" id="deleteForm">
      <input type="hidden" value="<%= id %>" name="id"/>
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
<script type="text/template" id="addTagsExercise">
  <div style="width:600px;" class="ctn-addTags">
    <h2>Add Exercises</h2>
    <form>
      <div class="form-ctn">
        <div class="input-ctn">
          <input type="hidden" value="<%= idroutine %>" class="idrout"/>
          <select name="tags" multiple="multiple" style="width:250px" class="multiselect-custom"><%= options %></select>
        </div><a href="javascript:;" class="btn btn-raised btn-info btn- btn-save">Add</a><a href="javascript:;" class="btn btn-raised btn-danger btn-cancel">Cancel</a>
      </div>
    </form>
  </div>
</script>@stop