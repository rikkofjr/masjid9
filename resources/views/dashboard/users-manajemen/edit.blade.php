@extends('layouts.dashboard')

@section('titleBar')
<div class="section-header">
    <h1>Edit User {{$user->name}}</h1>
    <div class="section-header-breadcrumb">
		<a class="btn btn-icon icon-left btn-primary" href="{{ route('admin.users.index') }}"> <i class="fas fa-chevron-left"></i> Kembali</a>
	</div>
	
</div>
@endsection

@section('mainContent')
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                {!! Form::model($user, ['method' => 'PATCH','route' => ['admin.users.update', $user->id]]) !!}
                <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <strong>Username :</strong>
                    {!! Form::text('username', null, array('placeholder' => 'username','class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <strong>Password:</strong>
                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <strong>Confirm Password:</strong>
                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple', 'style' => 'height:200px;')) !!}
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection