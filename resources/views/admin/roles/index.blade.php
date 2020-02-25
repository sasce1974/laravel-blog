@extends('layouts.blog')

@section('page-title')
    Admin | User Roles
@stop
@section('small-title')
    USER ROLES
@stop

@section('content')
    <div class="row">
        @foreach(['role_deleted', 'role_created', 'role_updated'] as $msg)
        @if(Session::has($msg))
            <div class="rounded p-3 mx-auto bg-info">
                <h4>{{session($msg)}}</h4>
            </div>
        @endif
        @endforeach
    </div>

    <div class="row">
        <div class="col-lg-3">

            <!--Create Role Form -->
            {!! Form::open(['method'=>'POST', 'action'=>'AdminRolesController@store', 'class'=>'input-group-append']) !!}
            {!! Form::text('name', null, ['placeholder'=>'Create New Role','class'=>'form-control rounded-left', 'aria-label'=>'Create New Role']) !!}
            <div class="input-group-append rounded-right">
                {!! Form::submit('Create', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
            <!--End of create catgory Form -->
            <div>
                @include('includes.form_errors')
            </div>
        </div>

        <div class="col-lg-8">
            <table class="table table-striped p-0">
                <thead>
                <tr style="vertical-align: middle;">
                    <th>ID</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Delete Role</th>
                </tr>
                </thead>
                <tbody>
                @if($roles)
                    @foreach($roles as $role)
                        <tr>
                            <td class="align-middle py-2">{{$role->id}}</td>
                            <td class="align-middle py-2">{{$role->name}}</td>
                            <td class="align-middle py-2">{{$role->created_at->diffForHumans()}}</td>
                            <td class="align-middle py-2">
                                {!! Form::open(['method'=>'DELETE', 'class'=>'align-middle m-0', 'action'=>['AdminRolesController@destroy', $role->id]]) !!}
                                {!! Form::submit('Delete', ['class'=>'btn btn-outline-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop