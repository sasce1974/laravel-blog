@extends('layouts.blog')

@section('page-title')
    Admin | Create post
@stop
@include('includes.tinymce')
@section('small-title')
    ADMIN CREATE POST
@stop

@section('content')

    <div class="row">
        <div class="col-lg-9 col-md-12">
            <!-- Add New Post Form -->
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form method="post" action="/admin/posts" enctype="multipart/form-data" class="add-new-post">
                        {{csrf_field()}}
                        <div class="input-group">
                            <div class="input-group-prepend mb-3">
                                <span class="input-group-text">Title</span>
                            </div>

                        <input name="title" class="form-control form-control-lg mb-3 col-lg-8" type="text" placeholder="Your Post Title">
                            <select name="category_id" class="form-control-lg col-lg-4 ml-2">
                                <option>Choose a category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{--TODO resolve problem images are not showing on the tiny editor--}}
                        {{--<div id="editor-container" class="add-new-post__editor mb-1"></div>--}}
                        <textarea name="content" rows="10" class="form-control"></textarea>
                        <div class="form-group mt-3 px-3 row">
                            <input type="file" name="file" class="form-control col-lg-8">
                            <button type="submit" class="btn btn-sm btn-accent ml-auto float-right">
                                <i class="material-icons mr-2">send</i>
                                Publish
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- / Add New Post Form -->
        </div>
        <div class="col-lg-3 col-md-12">
            <!-- Post Overview -->
            {{--<div class='card card-small mb-3'>--}}
                {{--<div class="card-header border-bottom">--}}
                    {{--<h6 class="m-0">Actions</h6>--}}
                {{--</div>--}}
                {{--<div class='card-body p-0'>--}}
                    {{--<ul class="list-group list-group-flush">--}}
                        {{--<li class="list-group-item p-3">--}}
                        {{--<span class="d-flex mb-2">--}}
                          {{--<i class="material-icons mr-1">flag</i>--}}
                          {{--<strong class="mr-1">Status:</strong> Draft--}}
                          {{--<a class="ml-auto" href="#">Edit</a>--}}
                        {{--</span>--}}
                            {{--<span class="d-flex mb-2">--}}
                          {{--<i class="material-icons mr-1">visibility</i>--}}
                          {{--<strong class="mr-1">Visibility:</strong>--}}
                          {{--<strong class="text-success">Public</strong>--}}
                          {{--<a class="ml-auto" href="#">Edit</a>--}}
                        {{--</span>--}}
                            {{--<span class="d-flex mb-2">--}}
                          {{--<i class="material-icons mr-1">calendar_today</i>--}}
                          {{--<strong class="mr-1">Schedule:</strong> Now--}}
                          {{--<a class="ml-auto" href="#">Edit</a>--}}
                        {{--</span>--}}
                            {{--<span class="d-flex">--}}
                          {{--<i class="material-icons mr-1">score</i>--}}
                          {{--<strong class="mr-1">Readability:</strong>--}}
                          {{--<strong class="text-warning">Ok</strong>--}}
                        {{--</span>--}}
                        {{--</li>--}}
                        {{--<li class="list-group-item d-flex px-3">--}}
                            {{--<button class="btn btn-sm btn-outline-accent">--}}
                                {{--<i class="material-icons">save</i> Save Draft</button>--}}
                            {{--<button class="btn btn-sm btn-accent ml-auto">--}}
                                {{--<i class="material-icons">file_copy</i> Publish</button>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
            <!-- / Post Overview -->
            <!-- Post Overview -->
            <div class='card card-small mb-3'>
                <div class="card-header border-bottom">
                    <h6 class="m-0">Categories</h6>
                </div>
                <div class='card-body p-0'>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-3 pb-2">
                            @foreach($categories as $category)
                                <div class="custom-control custom-radio mb-1">
                                    <input type="radio" id="category_id_{{$category->id}}" class="custom-control-input" name="category_id" value="{{$category->id}}">
                                    <label class="custom-control-label" for="category_id_{{$category->id}}">{{$category->name}}</label>
                                </div>
                            @endforeach
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="New category" aria-label="Add new category" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-white px-2" type="button">
                                        <i class="material-icons">add</i>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- / Post Overview -->
        </div>
    </div>

@stop