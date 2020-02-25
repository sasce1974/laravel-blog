@extends('layouts.blog')

@section('page-title')
    Posts
@stop

@section('small-title')
    POSTS
@stop

@section('head-scripts')
    <link href="css/blog-post.css" rel="stylesheet">
@stop

@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="col-sm-12 mb-4">
            <div class="card card-post card-post--1">
                <div class="card-post__image" style="min-height: 60vh; background-image: url(' {{ asset('storage/' . ($post['medias'] ? $post['medias']['file'] : "post_media/default.jpg"))}}')">
                    <a href="#" class="card-post__category badge badge-pill badge-dark">{{$post['category']['name']}}</a>
                    {{--badge info, dark, primary, warning--}}
                    <div class="card-post__author d-flex">
                        <a href="#" class="card-post__author-avatar card-post__author" style="background-image: url('/storage/avatars/{{$post['user']['name']}}.jpg');">Written by {{$post['user']['name']}}</a>
                    </div>
                </div>
                <div class="card-body" style="min-height: 40vh">
                    <h3 class="card-title">
                        <a class="text-fiord-blue" href="{{Auth::check() ? route('posts.show', $post['slug'] !='' ? $post['slug'] : $post['id']) : route('post', $post['slug'] !='' ? $post['slug'] : $post['id'])}}">{{$post['title']}}</a>
                        <a class="btn btn-primary float-right" href="{{route('posts.edit', $post['id'])}}">EDIT POST</a>
                    </h3>
                    {{--<p class="card-text d-inline-block mb-3">{!! strip_tags(str_limit($post->content, 150)) !!}</p>--}}
                    <p class="card-text d-inline-block mb-3">{!! $post['content'] !!}</p>
                    <span class="text-muted">Writen on {{$post['created_at']->format('d. F Y')}} by {{$post['user']['name']}}</span>
                </div>
            </div>
        </div>




        <!-- the actual blog post: title/author/date/content -->
        {{--<h3><a href="">{{$post->title}}</a></h3>--}}
        {{--<p class="lead"><i class="fa fa-user"></i> by <a href="">{{$post->user->name}}</a>--}}
        {{--</p>--}}
        {{--<hr>--}}
{{--        <p><i class="fa fa-calendar"></i>Posted {{$post->created_at->diffForHumans()}}</p>--}}
        {{--<p><i class="fa fa-tags"></i> Tags: <a href=""><span class="badge badge-info">Bootstrap</span></a> <a href=""><span class="badge badge-info">Web</span></a> <a href=""><span class="badge badge-info">CSS</span></a> <a href=""><span class="badge badge-info">HTML</span></a></p>--}}

        {{--<hr>--}}
        {{--@if($post->medias !="")--}}
            {{--<img class="img-responsive" height="100" src="{{asset('storage/' . $post->medias->file)}}" alt="Post photo">--}}
        {{--@else <img height="100" src="{{$post->medias ? $post->medias->file : 'http://placehold.it/900x300'}}" class="img-responsive img-rounded" alt="No photo">--}}
        {{--@endif--}}
        {{--<img src="http://placehold.it/900x300" class="img-responsive">--}}
        {{--<hr>--}}
        {{--<p class="lead">{!! $post->content!!}</p>--}}
        {{--<p>Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor.</p>--}}
        {{--<p>Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor. Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor.</p>--}}
        {{--<p>Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor. Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor.</p>--}}
        {{--<p>Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor. Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor.</p>--}}
        {{--<br/>--}}
        {{--<center><p><strong>Embed Twitter post:</strong>--}}

        {{--<!-- Place this tag in your head or just before your close body tag. -->--}}
        {{--<blockquote class="twitter-tweet" lang="hu"><p>Thousands of code samples at your fingertips! Literally, thousands: <a href="http://t.co/aHrsBZ7plp">http://t.co/aHrsBZ7plp</a> (via <a href="https://twitter.com/ch9">@ch9</a>) <a href="http://t.co/94CQJLOCzO">pic.twitter.com/94CQJLOCzO</a></p>— Microsoft Developer (@msdev) <a href="https://twitter.com/msdev/statuses/487959572230193152">2014. július 12.</a></blockquote>--}}
        {{--<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>--}}
        {{--</center>--}}
        {{--<br/>--}}
        {{--<center><p><strong>Embed Youtube player:</strong> </center>--}}

        {{--<div class="vid">--}}
        {{--<iframe width="560" height="315" src="//www.youtube.com/embed/bsPUMZlsZP8" frameborder="0" allowfullscreen></iframe>--}}
        {{--</div>--}}
        {{--<br/>--}}
        {{--<p><h3>This Youtube Player is responsive!</h3></p>--}}
        {{--<p>Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor.</p>--}}
        {{--<blockquote>--}}
        {{--<p>„Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.”</p>--}}
        {{--<footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>--}}
        {{--</blockquote>--}}
        {{--<p><h4>I like the post? Like this!</h4></p>--}}
        {{--<a href="https://twitter.com/share" class="twitter-share-button" data-url="">Tweet</a>--}}
        {{--<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>--}}

        {{--<div class="g-plusone" data-annotation="inline" data-width="300" data-href=""></div>--}}

        <!-- Helyezd el ezt a címkét az utolsó +1 gomb címke mögé. -->
        {{--<script type="text/javascript">--}}
            {{--(function() {--}}
                {{--var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;--}}
                {{--po.src = 'https://apis.google.com/js/platform.js';--}}
                {{--var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);--}}
            {{--})();--}}
        {{--</script>--}}
        {{--<br/>--}}
        {{--<hr>--}}

        <!-- the comment box -->
        <div class="well">
            <h4><i class="fa fa-paper-plane-o"></i> Leave a Comment:</h4>
            <form role="form">
                <div class="form-group">
                    <textarea class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-reply"></i> Submit</button>
            </form>
        </div>
        {{--<script src="https://apis.google.com/js/plusone.js">--}}
        {{--</script>--}}
        {{--<hr>--}}

        <!-- the comments -->
        @if(isset($comments))
        @foreach($comments as $comment)
            <h3><i class="fa fa-comment"></i> {{ $comment->user->name }} says:
                <small> {{$comment->created_at->diffForHumans()}}</small>
            </h3>
            <p>{{$comment->body}}</p>
        @endforeach
        @endif
        {{--<h3><i class="fa fa-comment"></i> User Two says:--}}
        {{--<small> 9:47 PM on August 24, 2014</small>--}}
        {{--</h3>--}}
        {{--<p>Excellent post! Thank You the great article, it was useful!</p>--}}

    </div>

    <div class="col-lg-4">
        {{--<div class="well">--}}
            {{--<h4><i class="fa fa-search"></i> Blog Search...</h4>--}}
            {{--<div class="input-group">--}}
                {{--<input type="text" class="form-control">--}}
                {{--<span class="input-group-btn">--}}
                            {{--<button class="btn btn-default" type="button">--}}
                                {{--<i class="fa fa-search"></i>--}}
                            {{--</button>--}}
                        {{--</span>--}}
            {{--</div>--}}
            <!-- /input-group -->
        {{--</div>--}}
        <!-- /well -->
        <div class="well">
            <h4><i class="fa fa-tags"></i> Popular Tags:</h4>
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-unstyled">
                        <li><a href=""><span class="badge badge-info">Windows 8</span></a>
                        </li>
                        <li><a href=""><span class="badge badge-info">C#</span></a>
                        </li>
                        <li><a href=""><span class="badge badge-info">Windows Forms</span></a>
                        </li>
                        <li><a href=""><span class="badge badge-info">WPF</span></a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="list-unstyled">
                        <li><a href=""><span class="badge badge-info">Bootstrap</span></a>
                        </li>
                        <li><a href=""><span class="badge badge-info">Joomla!</span></a>
                        </li>
                        <li><a href=""><span class="badge badge-info">CMS</span></a>
                        </li>
                        <li><a href=""><span class="badge badge-info">Java</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /well -->
        {{--<div class="well">--}}
            {{--<h4><i class="fa fa-thumbs-o-up"></i> Follow me!</h4>--}}
            {{--<ul>--}}
                {{--<p><a title="Facebook" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x"></i></span></a> <a title="Twitter" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x"></i></span></a> <a title="Google+" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-google-plus fa-stack-1x"></i></span></a> <a title="Linkedin" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-linkedin fa-stack-1x"></i></span></a> <a title="GitHub" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-github fa-stack-1x"></i></span></a> <a title="Bitbucket" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-bitbucket fa-stack-1x"></i></span></a></p>--}}
            {{--</ul>--}}
        {{--</div>--}}
        {{--<!-- /well -->--}}
        {{--<!-- /well -->--}}
        <div class="well">
            <h4><i class="fa fa-fire"></i> Popular Posts:</h4>
            <ul>
                <li><a href="">WPF vs. Windows Forms-Which is better?</a></li>
                <li><a href="">How to create responsive website with Bootstrap?</a></li>
                <li><a href="">The best Joomla! templates 2014</a></li>
                <li><a href="">ASP .NET cms list</a></li>
                <li><a href="">C# Hello, World! program</a></li>
                <li><a href="">Java random generator</a></li>
            </ul>
        </div>
        <!-- /well -->

        <!-- /well -->
        {{--<div class="well">--}}
            {{--<h4><i class="fa fa-book"></i> Featured books:</h4>--}}
            {{--<div class="row">--}}

                {{--<div class="col-lg-12">--}}
                    {{--<div class="cuadro_intro_hover " style="background-color:#cccccc;">--}}
                        {{--<p style="text-align:center; margin-top:20px;">--}}
                            {{--<img src="http://placehold.it/500x330" class="img-responsive" alt="">--}}
                        {{--</p>--}}
                        {{--<div class="caption">--}}
                            {{--<div class="blur"></div>--}}
                            {{--<div class="caption-text">--}}
                                {{--<h3 style="border-top:2px solid white; border-bottom:2px solid white; padding:10px;">Book 1</h3>--}}
                                {{--<p>Loren ipsum dolor si amet ipsum dolor si amet ipsum dolor...</p>--}}
                                {{--<a class=" btn btn-default" href="#"><i class="fa fa-plus"></i> INFO</span></a>--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</div>--}}

                {{--<div class="col-lg-12">--}}
                    {{--<div class="cuadro_intro_hover " style="background-color:#cccccc;">--}}
                        {{--<p style="text-align:center; margin-top:20px;">--}}
                            {{--<img src="http://placehold.it/500x330" class="img-responsive" alt="">--}}
                        {{--</p>--}}
                        {{--<div class="caption">--}}
                            {{--<div class="blur"></div>--}}
                            {{--<div class="caption-text">--}}
                                {{--<h3 style="border-top:2px solid white; border-bottom:2px solid white; padding:10px;">Book 2</h3>--}}
                                {{--<p>Loren ipsum dolor si amet ipsum dolor si amet ipsum dolor...</p>--}}
                                {{--<a class=" btn btn-default" href="#"><i class="fa fa-plus"></i> INFO</span></a>--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</div>--}}
            {{--</div>--}}


        {{--</div>--}}
        <!-- /well -->


    </div>

</div>

<footer>
    <h4 class="card-title">Other posts by {{$post->user->name}}</h4>
    <div class="row">
        @foreach(\App\Post::where('user_id', $post->user->id)->orderBy('id','desc')->get() as $post)
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
                                <a href="#" class="card-post__author-avatar card-post__author-avatar--small" style="background-image: url('/storage/avatars/{{$post->user->name}}.jpg');">Written by {{$post->user->name}}</a>
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
</footer>
@stop
