@extends('layouts.blog')

@section('page-title')
    Admin | Edit User
@stop

@section('small-title')
    EDIT USER
@stop

@section('content')
    <div>
        @include('includes.form_errors')
    </div>

    {{--<div class="media">--}}
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-small mb-4 pt-3">
                <div class="card-header border-bottom text-center">
                    <div class="mb-3 mx-auto">
                    @if($user->medias)
                        <img class="rounded-circle" width="110" src="{{ asset('storage/' .$user->medias['file'])}}" alt="User photo">
                    @else <img class="img-circle" height="110" src="http://placehold.it/200x200" alt="No user photo">
                    @endif
                    </div>
                    <h4 class="mb-0">{{$user->name}}</h4>
                    <span class="text-muted d-block mb-2">{{$user->role ? $user->role->name : 'Not defined!'}}</span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-4">
                        <div class="progress-wrapper">
                            <strong class="text-muted d-block mb-2">Posts by {{$user->name}}</strong>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{ $postsCount }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $postsCount }}%;">
                                    <span class="progress-value">{{ $postsCount }}%</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item p-4">
                        <strong class="text-muted d-block mb-2">About user</strong>
                        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio eaque, quidem, commodi soluta qui quae minima obcaecati quod dolorum sint alias, possimus illum assumenda eligendi cumque?</span>
                    </li>
                </ul>
            </div>
        </div>
        {{--<div class="media-body col-lg-8">--}}
        <div class="col-lg-8">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Account Details</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                        <div class="row">
                            <div class="col">

                                {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) !!}
                                <div class="form-group">
                                    {!! Form::label('role_id', 'Role') !!}
                                    {!! Form::select('role_id', $roles, null, ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('name', 'Name') !!}
                                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('email', 'Email') !!}
                                    {!! Form::email('email', null, ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('password', 'Password') !!}
                                    {!! Form::password('password', ['class'=>'form-control']) !!}
                                </div>
                                {{--Added textarea for user description, or notes...--}}
                                {{--<div class="form-row">--}}
                                    {{--<div class="form-group col-md-12">--}}
                                        {{--<label for="feDescription">Description</label>--}}
                                        {{--<textarea class="form-control" name="feDescription" rows="5">Some info here...</textarea>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                <div class="form-group">
                                    {!! Form::label('file', 'User photo') !!}
                                    {!! Form::file('file', null, ['class'=>'form-control']) !!}
                                </div>
                                <div class="custom-control custom-toggle custom-toggle-sm mb-1">
                    {{--                {!! Form::label('is_active', 'Status', ['class'=>'custom-control-label']) !!}--}}
                    {{--                {!! Form::checkbox('is_active', 1, ['class'=>'custom-control-input']) !!}--}}
                                    <input name="is_active" id="is_active_user" type="checkbox" class="custom-control-input" value="1" {{$user->is_active == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_active_user">Active Status</label>
                                </div>
                                {{--<div class="form-group border-top mt-2 pt-2">--}}
                    {{--                {!! Form::submit('Update user', ['class'=>'btn btn-primary float-left my-2']) !!}--}}
                                <button type="submit" class="btn btn-accent float-left my-2">
                                    <i class="material-icons">how_to_reg</i>
                                    Update
                                </button>
                                {{--</div>--}}
                                {!! Form::close() !!}
                                {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!}
                                {{--<div class="form-group">--}}
                    {{--                {!! Form::submit('Delete user', ['class'=>'btn btn-danger float-right my-2']) !!}--}}
                                <button type="submit" class="btn btn-danger float-right my-2">
                                    <i class="material-icons">delete</i>
                                    Delete
                                </button>
                                {{--</div>--}}
                {!! Form::close() !!}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@stop