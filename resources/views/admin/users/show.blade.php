@extends('layouts.blog')

@section('page-title')
    Admin | {{$user->name}} profile
@stop

@section('small-title')
    ADMIN - USER PROFILE
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
                    <span class="text-muted d-block mb-2">EMAIL: {{$user->email}}</span>
                    <span class="text-muted d-block mb-2">Role: {{$user->role ? $user->role->name : "Uncategorized"}}</span>
                    <span class="text-muted d-block mb-2">Status: {!! $user->is_active == 1 ? 'Active' : "<span class='bg-warning'>Not active</span>"!!}</span>
                    <span class="text-muted d-block mb-2">Profile created:{{$user->created_at->diffForHumans()}}</span>
                    <span class="text-muted d-block mb-2">Profile updated:{{$user->updated_at->diffForHumans()}}</span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-4">
                        <div class="progress-wrapper">
                            <strong class="text-muted d-block mb-2">Posts by {{$user->name}}</strong>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{$postsCount }}" aria-valuemin="0" aria-valuemax="100" style="width: {{$postsCount}}%;">
                                    <span class="progress-value">{{$postsCount }}%</span>
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
                                            <li><a href="{{route('posts.show', $post->slug)}}"><b>{{$post->title}}</b> | {{strip_tags(str_limit($post->content, 30))}}</a></li>
                                        @endforeach
                                    </ol>
                                @endif
                            </div>
                        </div>
                    </li>
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
                </ul>
            </div>
        </div>
    </div>

    {{--<div class="row">--}}
        {{--<div class="col-lg-3">--}}
            {{--@if($user->medias)--}}
                {{--<img class="mr-3 rounded-circle img-fluid card-img-top" height="200" src="{{asset('storage/'. $user->medias['file'])}}" alt="User photo">--}}
            {{--@else <img class="mr-3 rounded img-fluid" height="200" src="http://placehold.it/200x200" alt="No user photo">--}}
            {{--@endif--}}
        {{--</div>--}}
        {{--<div class="col-lg-8">--}}
            {{--<h3>Name: {{$user->name}}</h3>--}}
            {{--<h4>Email: {{$user->email}}</h4>--}}
            {{--<h4>Role: {{$user->role ? $user->role->name : "Uncategorized"}}</h4>--}}
            {{--<h4>Status: {{$user->is_active == 1 ? 'Active' : 'Not active'}}</h4>--}}
            {{--<h4>Profile created: {{$user->created_at->diffForHumans()}}</h4>--}}
            {{--<h4>Profile updated: {{$user->updated_at->diffForHumans()}}</h4>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
        {{--@if(count($user->posts) > 0)--}}
            {{--<h4>Posts:</h4>--}}
            {{--<ol>--}}
                {{--@foreach($user->posts as $post)--}}
                    {{--<li><a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a></li>--}}
                {{--@endforeach--}}
            {{--</ol>--}}
        {{--@endif--}}

        {{--@if(count($user->comments) > 0)--}}
            {{--<h4>Comments:</h4>--}}
            {{--<ol>--}}
                {{--@foreach($user->comments as $comment)--}}
                    {{--<li><h5><a href="{{route('posts.show', $comment->post_id)}}">{{$comment->post->title}}</a> - {{$comment->body}} </h5></li>--}}
                {{--@endforeach--}}
            {{--</ol>--}}
        {{--@endif--}}
    {{--</div>--}}

@stop