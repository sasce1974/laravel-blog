@extends('layouts.blog')

@section('page-title')
    Admin | Posts
@stop

@section('small-title')
    ADMIN POSTS
@stop

@section('head-scripts')
    <link href="css/blog-post.css" rel="stylesheet">
@stop

@section('content')
    <div class="row">
        @foreach($posts as $post)
            @if($post->medias)
            {{--Posts veritical--}}

        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card card-small card-post card-post--1">
                <div class="card-post__image" style="background-image: url(' {{asset('storage/' .$post->medias['file'])}}')">
                    <a href="#" class="card-post__category badge badge-pill badge-dark">{{$post->category['name']}}</a>
                    {{--badge info, dark, primary, warning--}}
                    <div class="card-post__author d-flex">
                        <a href="#" class="card-post__author-avatar card-post__author-avatar--small" style="background-image: url('storage/avatars/{{$post->user->name}}.jpg');">Written by {{$post->user->name}}</a>
                    </div>
                </div>
                <div class="card-body" style="min-height: 40vh">
                    <h5 class="card-title">
                        <a class="text-fiord-blue" href="{{Auth::check() ? route('posts.show', $post->slug !='' ? $post->slug : $post->id) : route('post', $post->slug !='' ? $post->slug : $post->id)}}">{{$post->title}}</a>
                    </h5>
                    <p class="card-text d-inline-block mb-3">{!! strip_tags(str_limit($post->content, 150)) !!}</p>
                    <span class="text-muted">{{$post->created_at->format('d. M Y')}}</span>
                </div>
            </div>
        </div>

            @endif
            @endforeach
    </div>
                {{--Posts without photo--}}
        <div class="row">
        @foreach($posts as $post)
            @if(!$post->medias)

                    <div class="col-lg-4">
                        <div class="card card-small card-post mb-4">
                            <div class="card-body" style="min-height: 40vh">
                                <a href="{{Auth::check() ? route('posts.show', $post->slug !='' ? $post->slug : $post->id) : route('post', $post->slug !='' ? $post->slug : $post->id)}}">
                                <h5 class="card-title">{{$post->title}}</h5>
                                </a>
                                <p class="card-text text-muted">{!! strip_tags(str_limit($post->content, 250)) !!}</p>
                            </div>
                            <div class="card-footer border-top d-flex">
                                <div class="card-post__author d-flex">
                                    <a href="#" class="card-post__author-avatar card-post__author-avatar--small" style="background-image: url('storage/avatars/{{$post->user->name}}.jpg');">Written by {{$post->user->name}}</a>
                                    <div class="d-flex flex-column justify-content-center ml-3">
                                        <span class="card-post__author-name">{{$post->user->name}}</span>
                                        <small class="text-muted">{{$post->created_at->format('d F Y')}}</small>
                                    </div>
                                </div>
                                <div class="my-auto ml-auto">
                                    <a class="btn btn-sm btn-white" href="#">
                                        <i class="far fa-bookmark mr-1"></i> Bookmark </a>
                                </div>
                            </div>
                        </div>
                    </div>

            @endif
        @endforeach
        </div>

    {{--Posts horizontal--}}
    <div class="row">
        <div class="col-lg-6 col-sm-12 mb-4">
            <div class="card card-small card-post card-post--aside card-post--1">
                <div class="card-post__image" style="background-image: url('images/content-management/5.jpeg');">
                    <a href="#" class="card-post__category badge badge-pill badge-info">Travel</a>
                    <div class="card-post__author d-flex">
                        <a href="#" class="card-post__author-avatar card-post__author-avatar--small" style="background-image: url('images/avatars/0.jpg');">Written by Anna Ken</a>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        <a class="text-fiord-blue" href="#">Attention he extremity unwilling on otherwise cars backwards yet</a>
                    </h5>
                    <p class="card-text d-inline-block mb-3">Conviction up partiality as delightful is discovered. Yet jennings resolved disposed exertion you off. Left did fond drew fat head poor jet pan flying over...</p>
                    <span class="text-muted">29 February 2019</span>
                </div>
            </div>
        </div>
    </div>

    {{--Posts without photo--}}
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-small card-post mb-4">
                <div class="card-body">
                    <h5 class="card-title">Had denoting properly jointure which well books beyond</h5>
                    <p class="card-text text-muted"> In said to of poor full be post face snug. Introduced imprudence see say unpleasing devonshire acceptance son. Exeter longer...</p>
                </div>
                <div class="card-footer border-top d-flex">
                    <div class="card-post__author d-flex">
                        <a href="#" class="card-post__author-avatar card-post__author-avatar--small" style="background-image: url('images/avatars/1.jpg');">Written by James Khan</a>
                        <div class="d-flex flex-column justify-content-center ml-3">
                            <span class="card-post__author-name">James Khan</span>
                            <small class="text-muted">21 March 2011</small>
                        </div>
                    </div>
                    <div class="my-auto ml-auto">
                        <a class="btn btn-sm btn-white" href="#">
                            <i class="far fa-bookmark mr-1"></i> Bookmark </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Post with photo vertical 4 in a row no user pic and no category tag--}}
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card card-small card-post h-100">
                <div class="card-post__image" style="background-image: url('images/content-management/7.jpeg');"></div>
                <div class="card-body">
                    <h5 class="card-title">
                        <a class="text-fiord-blue" href="#">Extremity so attending objection as engrossed</a>
                    </h5>
                    <p class="card-text">Morning prudent removal an letters by. On could my in order never it. Or excited certain sixteen it to parties colonel not seeing...</p>
                </div>
                <div class="card-footer text-muted border-top py-3">
                    <span class="d-inline-block">By
                      <a class="text-fiord-blue" href="#">Alene Trenton</a> in
                      <a class="text-fiord-blue" href="#">News</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{$posts->links()}}
@stop