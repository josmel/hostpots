@extends('admin._layouts.layout')
@section('content')
<div id="wrapper" class="container-page">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-primary">
          <div class="panel-heading"> 
            <h3 class="panel-title">Perfil</h3>
          </div>
          <div class="panel-body">
            {!!Form::model($admin,array('class'=>'form-horizontal','role'=>'form','files'=>'true','data-parsley-validate'))!!}
            {!!Form::input('hidden','id',null,array('class'=>'form-control'))!!}
            <div class="form-group">{!!Form::label('name','Name: ',array('class'=>'col-md-4 control-label'))!!}
              <div class="col-md-6">{!!Form::input('text','name',null,array('class'=>'form-control','required'))!!}</div>
            </div>
            <div class="form-group">{!!Form::label('lastname','Last Name: ',array('class'=>'col-md-4 control-label'))!!}
              <div class="col-md-6">{!!Form::input('text','lastname',null,array('class'=>'form-control','required'))!!}</div>
            </div>
            <div class="form-group">{!!Form::label('email','E-Mail: ',array('class'=>'col-md-4 control-label'))!!}
              <div class="col-md-6">{!!Form::input('email','email',null,array('class'=>'form-control','required'))!!}</div>
            </div>
            <div class="form-group">{!!Form::label('password','Password (leave if you do not change): ',array('class'=>'col-md-4 control-label'))!!}
              <div class="col-md-6">{!!Form::password('password',array('class'=>'form-control'))!!}</div>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">{!! Form::button('Save', array('class'=>'btn btn-primary', 'type'=>'submit')) !!}</div>
            </div>{!!Form::close()!!}
          </div>@if($errors->any())
          <ul class="alert alert-danger">@foreach($errors->all() as $error)
            <li>{{$error}}</li>@endforeach
          </ul>@endif
          @if($messageSuccess)
          <ul class="alert alert-success">
            <li>{{$messageSuccess}}</li>
          </ul>@endif
        </div>
      </div>
    </div>
  </div>
</div>@stop