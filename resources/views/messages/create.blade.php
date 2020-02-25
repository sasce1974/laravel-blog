@extends('layouts.blog')

@section('page-title')
    New Message
@stop

@section('small-title')
    <a class="btn btn-sm btn-success py-0" href="{{route('new_message')}}"><b><i class="fa fa-edit mr-2"></i>CREATE NEW</b></a> | <a class="btn btn-sm btn-sm btn-outline-info py-0" href="{{route('inbox')}}"><i class="fa fa-envelope mr-2"></i>INBOX</a> | <a class="btn btn-sm btn-outline-info py-0" href="/sent_messages"><i class="fa fa-envelope-open mr-2"></i>SENT</a> | <a class="btn btn-sm btn-outline-danger py-0" href=""><i class="fa fa-trash mr-2"></i>TRASHED</a>
@stop

@section('content')
<div>
    {!! Form::open(['method'=>'POST', 'action'=>'MessageController@send', 'files'=>true]) !!}
    <div class="row">
        <div class="form-group col-lg-4">
            {!! Form::label('sent_to', 'Send to') !!}
            {!! Form::text('sent_to', isset($author) ? $author : null, ['placeholder'=>'User name','class'=>'form-control']) !!}
        </div>
        <div class="form-group col-lg-8">
            {!! Form::label('subject', 'Subject') !!}
            {!! Form::text('subject', isset($subject) ? $subject : null, ['placeholder'=>'Message Subject','class'=>'form-control']) !!}
        </div>
    </div>
        <div class="form-group">
{{--            {!! Form::textarea('content', $content ? $content : null, ['class'=>'form-control', 'style'=>'height:50vh']) !!}--}}
            <pre><textarea name="content" class="form-control", style='height:50vh'>{{isset($content) ? $content : null }}</textarea></pre>
        </div>
        <div class="form-group">
{{--            {!! Form::submit('Send', ['class'=>'btn btn-primary']) !!}--}}
            <button type="submit" class="btn btn-primary float-right"><i class="fa fa-send mx-2"></i> Send</button>
        </div>
    {!! Form::close() !!}
</div>
@stop