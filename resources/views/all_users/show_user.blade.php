@extends('layouts.blog')

@section('page-title')
    User profile | {{$user->name}}
@stop

@section('small-title')
    USER PROFILE
@stop

@section('content')
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
                    <div class="text-left">
                        @if($user->id === Auth::id())
                        <span class="text-muted d-block mb-2">EMAIL: {{$user->email}}</span>
                        @endif
                        <span class="text-muted d-block mb-2">Role: {{$user->role ? $user->role->name : "Uncategorized"}}</span>
                        <span class="text-muted d-block mb-2">Status: {{$user->is_active == 1 ? 'Active' : 'Not active'}}</span>
                        <span class="text-muted d-block mb-2">Member since:{{$user->created_at->diffForHumans()}}</span>
                        {{--<span class="text-muted d-block mb-2">Profile updated:{{$user->updated_at->diffForHumans()}}</span>--}}

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
                    <li class="list-group-item p-4">
                    @if(Auth::id() === $user->id)
                        <a href="{{route('edit_user')}}" class="btn btn-primary">EDIT</a>
                    @endif
                    </li>
                </ul>
            </div>
        </div>
        </div>
        {{--Posts, comments, replies of this user--}}
        <div class="col-lg-8">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">User Activities Details</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                        <div class="row">
                            <div class="col">
                                @if(count($user->posts) > 0)
                                    <h4>Posts:</h4>
                                    <ol>
                                        @foreach($user->posts as $post)
                                            <li><a href="{{route('posts.show', $post->slug)}}"><b>{{$post->title}}</b> | {!! strip_tags(str_limit($post->content, 50))!!}</a></li>
                                        @endforeach
                                    </ol>
                                @endif
                            </div>
                        </div>
                    </li>
                    @if(Auth::user() == $user)
                    <li class="list-group-item p-3">
                        <div class="row">
                            <div class="col">
                                @if(count($user->comments) > 0)
                                    <h4>Comments:</h4>
                                    <ol>
                                        @foreach($user->comments as $comment)
                                            <li><a href="{{route('comments.show', $comment->id) . '?#comentElementId-' . $comment->id}}">{{strip_tags(str_limit($comment->content, 30))}}</a></li>
                                        @endforeach
                                    </ol>
                                @endif
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item p-3">
                        <div class="row">
                            <div class="col">
                                @if(count($user->replies) > 0)
                                    <h4>Replies:</h4>
                                    <ol>
                                        @foreach($user->replies as $reply)
                                            <li><a href="{{route('replies.show', $reply->id) . '?#replyElementId-' . $reply->id}}">{{strip_tags(str_limit($reply->content, 30))}}</a></li>
                                        @endforeach
                                    </ol>
                                @endif
                            </div>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>

        </div>
    </div>


    {{--@foreach(['user_deleted', 'user_created', 'user_updated'] as $msg)--}}
        {{--@if(Session::has($msg))--}}
            {{--<div class="col-lg-8 rounded p-1 mx-auto mb-3 bg-info text-center">--}}
                {{--<h4>{{session($msg)}}</h4>--}}
            {{--</div>--}}
        {{--@endif--}}
    {{--@endforeach--}}
    {{--@if($user->id == Auth::id())--}}
        {{--<a href="{{route('edit_user')}}"><h3 class="page-header well">{{$user->name}}</h3></a>--}}
    {{--@else--}}
        {{--<h3 class="page-header well">{{$user->name}}</h3>--}}
    {{--@endif--}}

    {{--<div class="row">--}}
    {{--@include('includes.form_errors')--}}
    {{--</div>--}}
    {{--<div class="row">--}}
        {{--<div class="col-sm-4">--}}
            {{--@if($user->medias)--}}
                {{--<img class="mr-3 rounded-circle img-fluid card-img-top" height="200" src="{{asset('storage/' . $user->medias['file'])}}" alt="User photo">--}}
            {{--@else <img class="mr-3 rounded-circle img-fluid" height="200" src="http://placehold.it/200x200" alt="No user photo">--}}
            {{--@endif--}}
        {{--</div>--}}
        {{--<div class="col-sm-4">--}}
            {{--<h4>Role: {{$user->role->name}}</h4>--}}
            {{--<h4>Status:--}}
                {{--@if($user->is_active == 1)--}}
                    {{--Active</h4>--}}
            {{--@else--}}
                {{--Inactive</h4>--}}
            {{--@endif--}}
            {{--@if(Auth::user()->isAdmin() or $user->email == Auth::user()->email)--}}
                {{--<h4>Email: {{$user->email}}</h4>--}}
            {{--@endif--}}

            {{--@if(count($user->posts) > 0)--}}
                {{--<h4>Posts:</h4>--}}
                {{--<ol>--}}
                    {{--@foreach($user->posts as $post)--}}
                        {{--<li><a href="{{route('posts.comments.show', $post->id)}}">{{$post->title}}</a></li>--}}
                        {{--<li>{{$post->title}}</li>--}}
                    {{--@endforeach--}}
                {{--</ol>--}}
            {{--@endif--}}

        {{--</div>--}}
        {{--<div class="col-sm-4">--}}
            {{--@if(count($user->comments) > 0)--}}
                {{--<h4>Comments:</h4>--}}
                {{--<ol>--}}
                    {{--@foreach($user->comments as $comment)--}}
                        {{--<li><h5><a href="{{route('posts.comments.show', $comment->post_id)}}">{{$comment->post->title}}</a> - {{$comment->body}} </h5></li>--}}
                    {{--@endforeach--}}
                {{--</ol>--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--</div>--}}
@stop