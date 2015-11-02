
@extends('admin._layouts.layout')
@section('content')
<div id="wrapper" class="container-page">@if(session()->has('messageSuccess'))
  <ul class="alert alert-success">
    <li>{{session('messageSuccess')}}</li>
  </ul>@endif
  <h2>Users</h2><a href="/admpanel/user" class="btn btn-success">New</a>
  <section>
    <table id="categoryTable" data-url="/admpanel/user-data" data-nofilter="0,1,2,8,12" data-col="photo,flag_first_time,typeregister,points,routines,name,email,age,location,gender,weight,height,action" class="tables table-striped">
      <thead>
        <tr class="info">
          <td>Image</td>
          <td>Complete Registration?</td>
          <td>Register Type</td>
          <td>Points</td>
          <td>Routines</td>
          <td>Name</td>
          <td>Email</td>
          <td>Age</td>
          <td>Location</td>
          <td>Gender</td>
          <td>Weight</td>
          <td>Height</td>
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
        <h1>Edit Record</h1>
      </header>
      <div class="modal-ctn--form">
        <div class="form-group">
          <input placeholder="Nombre" name="name" value="<%= name %>" data-parsley-required="true" class="form-control floating-label"/>
        </div>
        <div class="modal-ctn--actions">
          <button type="submit" class="btn btn-primary">Send</button>
        </div>
      </div>
    </form>
  </div>
</script>
<script type="text/template" id="tplDelete">
  <div class="modal-ctn">
    <form action="#" data-parsley-validate="data-parsley-validate" data-url="delete-user" data-method="POST" id="deleteForm">
      <input type="hidden" value="<%= id %>" name="id"/>
      <header>
        <h1>Confirmate</h1>
      </header>
      <div class="modal-ctn--form">
        <div class="form-group">
          <h4>Delete record?</h4>
        </div>
        <div class="modal-ctn--actions">
          <button type="submit" class="btn btn-primary">Delete</button><a href="javascript:;" class="btn btn-danger btn-danger--modal">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</script>@stop