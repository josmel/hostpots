
@extends('admin._layouts.layout_login')
@section('content')
<div id="wrapper" class="container-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-5 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Login</div>
          <div class="panel-body">@if (count($errors) > 0)
            <div class="alert alert-danger"><strong>
                Whoops!
                Hubo algunos problemas con su entrada. <br/><br/></strong>
              <ul>@foreach ($errors->all() as $error)
                <li>{{ $error }}</li>@endforeach
              </ul>
            </div>@endif
            <form role="form" method="POST" action="{{ url('/admpanel/auth/login') }}" class="form-horizontal">
              <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
              <div class="form-group">
                <label class="col-md-4 control-label">E-Mail Address</label>
                <div class="col-md-6">
                  <input type="email" name="email" value="{{ old('email') }}" class="form-control"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Password</label>
                <div class="col-md-6">
                  <input type="password" name="password" class="form-control"/>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-4"></div>
              </div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">Login</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>@endsection