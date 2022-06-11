@extends('layouts.dashboard')

@section('pageTitle')
    Role Management
@endsection

@section('mainContent')
<section class="section">
    <div class="section-header">
        <h1>Role Management</h1>
        <div class="section-header-breadcrumb">
            @can('role-create')
                <a class="btn btn-icon icon-left btn-success" href="{{ route('admin.roles.create') }}"> <i class="far fa-edit"></i> Create New Role</a>
            @endcan
        </div>
    </div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p> 
    </div>
@endif

<table class="table table-striped">
  <tr>
    <thead>
        <td>No</td>
        <td>Name</td>
        <td width="280px">Action</td>
    </thead>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('admin.roles.show',$role->id) }}">Show</a>
            @can('role-edit')
                <a class="btn btn-primary" href="{{ route('admin.roles.edit',$role->id) }}">Edit</a>
            @endcan
            @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['admin.roles.destroy', $role->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>


{!! $roles->render() !!}
</section>
@endsection