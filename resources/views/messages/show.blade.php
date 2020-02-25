@extends('layouts.blog')

@section('page-title')
    Message | {{$message->subject}}
@stop

@section('small-title')
    <a class="btn btn-sm btn-success py-0" href="{{route('new_message')}}"><b><i class="fa fa-edit mr-2"></i>CREATE NEW</b></a> | <a class="btn btn-sm btn-sm btn-outline-info py-0" href="{{route('inbox')}}"><i class="fa fa-envelope mr-2"></i>INBOX</a> | <a class="btn btn-sm btn-outline-info py-0" href="/sent_messages"><i class="fa fa-envelope-open mr-2"></i>SENT</a> | <a class="btn btn-sm btn-outline-danger py-0" href=""><i class="fa fa-trash mr-2"></i>TRASHED</a>
@stop

@section('content')

    <span>From: {{$message->user->name}}</span>
    <small>Sent: {{$message->created_at->diffForHumans()}}</small>
    <a href="{{route('message_reply', $message->id)}}" class="btn btn-link">Reply</a>

    <div class="text-xl-left w-auto">
        <label>Subject: </label> <span> {{$message->subject}}</span>
    </div>

    <div class="card card-body w-auto p-2 input-group" style="min-height: 60vh">
        {!! nl2br(e($message->content)) !!}
    </div>



@stop