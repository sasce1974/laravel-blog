@extends('layouts.blog')

@section('page-title')
    Edit User profile | {{$user->name}}
@stop

@section('small-title')
    EDIT USER PROFILE
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
            @if($user->medias !="")
                {{--TODO: find more convenient way to find user!--}}
                <img class="rounded-circle" height="110" src="{{ asset('storage/' .$user->medias['file'])}}" alt="User photo">
            @else <img class="rounded-circle" height="110" src="http://placehold.it/200x200" alt="No user photo">
            @endif
                    </div>
                    <h4 class="mb-0">{{$user->name}}</h4>
                    <span class="text-muted d-block mb-2">{{$user->role->name}}</span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-4">
                        <div class="progress-wrapper">
                            <strong class="text-muted d-block mb-2">User activity: </strong>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{$postsCount}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$postsCount}}%">
                                    <span class="progress-value">{{$postsCount}}%</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    @if($user->about)
                    <li class="list-group-item p-4">
                        <strong class="text-muted d-block mb-2">About user</strong>
                        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio eaque, quidem, commodi soluta qui quae minima obcaecati quod dolorum sint alias, possimus illum assumenda eligendi cumque?</span>
                    </li>
                    @endif
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
            {!! Form::model($user, ['method'=>'PATCH', 'action'=>['UserController@update'], 'files'=>true]) !!}

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
            <div class="form-group">
                {!! Form::label('file', 'User photo') !!}
                {!! Form::file('file', null, ['class'=>'form-control']) !!}
            </div>

            <button type="submit" class="btn btn-primary float-left my-2">
                <i class="material-icons">how_to_reg</i>
                Update
            </button>
            {!! Form::close() !!}
            {!! Form::open(['method'=>'DELETE', 'action'=>['UserController@destroy', $user->id]]) !!}
            <button type="submit" class="btn btn-danger float-right my-2">
                <i class="material-icons">delete</i>
                Delete account
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