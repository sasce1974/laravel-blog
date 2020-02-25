@extends('layouts.blog')

@section('page-title')
    Post Categories
@stop
@section('small-title')
    POST CATEGORIES
@stop

@section('content')
    <div class="row">
        @foreach(['category_deleted', 'category_created', 'category_updated'] as $msg)
            @if(Session::has($msg))
                <div class="rounded p-3 mx-auto bg-info">
                    <h4>{{session($msg)}}</h4>
                </div>
            @endif
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-3">

            <!--Create Category Form -->
            {{--<div class="input-group mb-3">--}}
                {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store', 'class'=>'input-group-append']) !!}
                {{--<div class="form-group">--}}
    {{--                {!! Form::label('name', 'Create New Category:') !!}--}}
                    {!! Form::text('name', null, ['placeholder'=>'Create New Category','class'=>'form-control rounded-left', 'aria-label'=>'Create New Category']) !!}
                {{--</div>--}}
                <div class="input-group-append rounded-right">
                    {!! Form::submit('Create', ['class'=>'btn btn-success']) !!}
                </div>
                {!! Form::close() !!}
            {{--</div>--}}
            <!--End of create catgory Form -->
            <div>
                @include('includes.form_errors')
            </div>
        </div>

        <div class="col-lg-8">
            <table class="table table-striped p-0">
                <thead>
                <tr style="vertical-align: middle;">
                    <th>ID</th>
                    <th>Category</th>
                    <th>Created</th>
                    <th>Delete Category</th>
                </tr>
                </thead>
                <tbody>
                @if($categories)
                    @foreach($categories as $category)
                        <tr>
                            <td class="align-middle py-2">{{$category->id}}</td>
                            {{--<td style="vertical-align: middle;"><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->name}}</a></td>--}}
                            <td class="align-middle py-2">{{$category->name}}</td>
                            <td class="align-middle py-2">{{$category->created_at->diffForHumans()}}</td>
    {{--                        <td style="vertical-align: middle;">{{$category->updated_at->diffForHumans()}}</td>--}}
                            <td class="align-middle py-2">
                                {!! Form::open(['method'=>'DELETE', 'class'=>'align-middle m-0', 'action'=>['AdminCategoriesController@destroy', $category->id]]) !!}
                                {{--<div class="form-group">--}}
                                    {!! Form::submit('Delete', ['class'=>'btn btn-outline-danger']) !!}
                                {{--</div>--}}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop