@extends('layouts.blog')

@section('page-title')
    Admin | Posts
@stop

@section('small-title')
    ADMIN POSTS
@stop

@section('content')
    <div>
        @include('includes.form_errors')
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-body">
    <table class="table table-striped">
        <thead>
        <tr style="vertical-align: middle;">
            <th>Edit</th>
            <th>ID</th>
            <th>Author</th>
            {{--<th>Category</th>--}}
            <th>Title</th>
            <th>Content</th>
            <th>Approved</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>
        @if(count($posts)>0)
            @foreach($posts as $post)
                <tr>
                    <td class="align-middle py-2"><a href="{{route('posts.edit', $post->id)}}">Edit</a></td>
                    <td class="align-middle py-2">{{$post->id}}</td>
                    <td class="align-middle py-2"><a href="{{route('show_user', $post->user_id)}}">{{$post->user->name}}</a></td>
                    {{--<td class="align-middle py-2">{{count($post->category)>0 ? $post->category['name'] : "Uncategorized"}}</td>--}}
                    <td class="align-middle py-2"><a href="{{route('posts.show', $post->slug !='' ? $post->slug : $post->id)}}">{{$post->title}}</a></td>
                    <td class="align-middle py-2">{!! strip_tags(str_limit($post->content, 30))!!}</td>
                    <td class="align-middle py-2">{{$post->is_approved == 1 ? "Approved" : "Not Approved"}}</td>
                    <td class="align-middle py-2">{{$post->created_at->diffForHumans()}}</td>
                    <td class="align-middle py-2">{{$post->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @else
{{--            {{Session::flash('msg', "There are no posts")}}--}}
            <tr><td colspan="9">There are no posts</td></tr>
        @endif
        </tbody>
    </table>
    <div class="row text-center">
        <div class="col-lg-6 mx-auto">
            {{$posts->links()}}
        </div>
    </div>
                </div>
            </div>
        </div>

        {{--<div class="col-lg-3 col-md-12">--}}
            {{--<!-- Post Overview -->--}}
            {{--<div class='card card-small mb-3'>--}}
                {{--<div class="card-header border-bottom">--}}
                    {{--<h6 class="m-0">Categories</h6>--}}
                {{--</div>--}}
                {{--<div class='card-body p-0'>--}}
                    {{--<ul class="list-group list-group-flush">--}}
                        {{--<li class="list-group-item px-3 pb-2">--}}
                            {{--@foreach($categories as $category)--}}
                            {{--<div class="custom-control custom-checkbox mb-1">--}}
                                {{--<input type="checkbox" class="custom-control-input" id="{{$category->id}}" checked>--}}
                                {{--<label class="custom-control-label" for="category1">{{$category->name}}</label>--}}
                            {{--</div>--}}
                            {{--@endforeach--}}
                            {{--<div class="custom-control custom-checkbox mb-1">--}}
                                {{--<input type="checkbox" class="custom-control-input" id="category2" checked>--}}
                                {{--<label class="custom-control-label" for="category2">Design</label>--}}
                            {{--</div>--}}
                            {{--<div class="custom-control custom-checkbox mb-1">--}}
                                {{--<input type="checkbox" class="custom-control-input" id="category3">--}}
                                {{--<label class="custom-control-label" for="category3">Development</label>--}}
                            {{--</div>--}}
                            {{--<div class="custom-control custom-checkbox mb-1">--}}
                                {{--<input type="checkbox" class="custom-control-input" id="category4">--}}
                                {{--<label class="custom-control-label" for="category4">Writing</label>--}}
                            {{--</div>--}}
                            {{--<div class="custom-control custom-checkbox mb-1">--}}
                                {{--<input type="checkbox" class="custom-control-input" id="category5">--}}
                                {{--<label class="custom-control-label" for="category5">Books</label>--}}
                            {{--</div>--}}
                        {{--</li>--}}
                        {{--<li class="list-group-item d-flex px-3">--}}
                            {{--<div class="input-group">--}}
                                {{--<input type="text" class="form-control" placeholder="New category" aria-label="Add new category" aria-describedby="basic-addon2">--}}
                                {{--<div class="input-group-append">--}}
                                    {{--<button class="btn btn-white px-2" type="button">--}}
                                        {{--<i class="material-icons">add</i>--}}
                                    {{--</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            </div>
            <!-- / Post Overview -->
        </div>
    </div>


@stop