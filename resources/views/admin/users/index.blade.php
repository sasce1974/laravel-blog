@extends('layouts.blog')

@section('page-title')
    Users
@stop

@section('small-title')
    Users
@stop

@section('content')

@include('includes.form_errors')
    <table class="table table-striped">
        <thead>
        <tr style="vertical-align: middle;">
            @if(Auth::user()->isAdmin())
            <th>Edit</th>
            <th>ID</th>
            @endif
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Is active</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $user)
                <tr>
                    @if(Auth::user()->isAdmin())
                    <td class="align-middle py-2"><a href="{{route('users.edit', $user->id)}}">Edit</a></td>
                    <td class="align-middle py-2">{{$user->id}}</td>
                    @endif
                    <td class="align-middle py-2">
                        @if($user->medias)
                            <img class="rounded" height="50" src="{{ asset('storage/' . $user->medias->file)}}" alt="User photo">
{{--                            <img class="rounded" height="50" src="/images/{{ $user->medias['file'] }}" alt="User photo">--}}
                        @else <img class="rounded" height="50" src="http://placehold.it/50x50" alt="No user photo">
                        @endif
                    </td>
                    @if(Auth::user()->isAdmin())
                    <td class="align-middle py-2"><a href="{{route('users.show', $user->id)}}">{{$user->name}}</a></td>
                    <td class="align-middle py-2">{{$user->email}}</td>
                    @else
                    <td class="align-middle py-2"><a href="{{route('show_user', $user->id)}}">{{$user->name}}</a></td>
                    <td class="align-middle py-2">{{ Auth::id() == $user->id ? $user->email : "Private"}}</td>
                    @endif
                    <td class="align-middle py-2">{{$user->role ? $user->role->name : "Uncategorized"}}</td>
                    <td class="align-middle py-2">{{$user->is_active == 1 ? 'Active' : 'Not active'}}</td>
                    <td class="align-middle py-2">{{$user->created_at->diffForHumans()}}</td>
                    <td class="align-middle py-2">{{$user->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>


@stop