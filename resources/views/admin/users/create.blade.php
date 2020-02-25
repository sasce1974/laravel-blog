@extends('layouts.blog')

@section('page-title')
    Admin | Create Users
@stop

@section('small-title')
    CREATE USER
@stop

@section('content')
    <div>
        @include('includes.form_errors')
    </div>
    <div class="row">
    <div class="col-lg-12">
    {!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store', 'files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('role_id', 'Role') !!}
            {!! Form::select('role_id', $roles, null, ['placeholder'=>'Pick a role','class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['placeholder'=>'eg. John Smith','class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::email('email', null, ['placeholder'=>'email@domain.com','class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', ['placeholder'=>'Password (min. 6 char.)','class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('file', 'User photo') !!}
            {!! Form::file('file', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary float-right">
                <i class="material-icons">person_add</i>
                Create
            </button>
{{--            {!! Form::submit('Create user', ['class'=>'btn btn-primary float-right']) !!}--}}
        </div>
    {!! Form::close() !!}
    </div>
    </div>
@stop