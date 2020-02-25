@extends('layouts.blog')

@section('page-title')
   Messages | {{Auth::user()->name}}
@stop

@section('small-title')
    <a class="btn btn-sm btn-success py-0" href="{{route('new_message')}}"><b><i class="fa fa-edit mr-2"></i>CREATE NEW</b></a> | <a class="btn btn-sm btn-sm btn-outline-info py-0" href="{{route('inbox')}}"><i class="fa fa-envelope mr-2"></i>INBOX</a> | <a class="btn btn-sm btn-outline-info py-0" href="/sent_messages"><i class="fa fa-envelope-open mr-2"></i>SENT</a> | <a class="btn btn-sm btn-outline-danger py-0" href=""><i class="fa fa-trash mr-2"></i>TRASHED</a>
@stop

@section('content')
    {{--<a class="btn btn-outline-info float-right" href="/sent_messages">Sent messages</a>--}}
    {{--@foreach(['msg_deleted', 'msg_sent'] as $msg)--}}
        {{--@if(Session::has($msg))--}}
            {{--<div class="col-lg-8 rounded p-1 mx-auto mb-3 bg-info text-center">--}}
                {{--<h4>{{session($msg)}}</h4>--}}
            {{--</div>--}}
        {{--@endif--}}
    {{--@endforeach--}}
    @include('includes.form_errors')
    @if(count($messages)>0)
    <table class="table table-striped table-hover table-sm">
        <thead class="thead-dark">
        <tr style="vertical-align: middle;">
            <th><input type="checkbox" id="chkbox_option" name="msgCheckboxArray"></th>
            <th>From</th>
            <th>Subject</th>
            <th>Content</th>
            <th>Date/Time</th>
            <th>Starred</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>

        @foreach($messages as $message)
            <tr class="my-0 py-0 {{$message->viewed == 0 ? "font-weight-bold" : ""}}">
                <th class="align-middle py-2"><input type="checkbox" name="msgCheckboxArray[]" value="1"></th>
                <td class="align-middle py-2"><a href="{{route('show_message', $message->id)}}">{{$message->user->name}}</a></td>
                <td class="align-middle py-2"><a href="{{route('show_message', $message->id)}}">{{str_limit($message->subject, 15)}}</a></td>
                <td class="align-middle py-2"><a href="{{route('show_message', $message->id)}}">{{str_limit($message->content, 40)}}</a></td>
                <td class="align-middle py-2"><a href="{{route('show_message', $message->id)}}">{{$message->created_at->diffForHumans()}}</a></td>
                <td class="align-middle py-2"><input type="checkbox" name="starred" value="1"></td>
                <td class="align-middle py-2">
                    {!! Form::open(['method'=>'DELETE', 'action'=>['MessageController@destroy',$message->id], 'class'=>'py-0 my-0']) !!}
{{--                            {!! Form::submit('<i class="fa fa-trash mx-2"></i>', ['class'=>'btn btn-danger py-1 my-0']) !!}--}}
                        <button type="submit" class='btn btn-danger py-1 my-0'><i class="fa fa-trash mx-1"></i></button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <h4 class="page-title">There are no messages</h4>
    @endif

@stop