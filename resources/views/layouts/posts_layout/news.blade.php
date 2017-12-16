@extends('layouts.post_master')

@section('post_title')
    {{$news->title}}
@endsection
@section('post_title_url')
    {{url()->route('showNews',$news->title_seo)}}
@endsection

@section('author')
    {{$news->author->name}}
@endsection

@section('date')
    {{$news->date}}
@endsection

@section('time')
    {{$news->time}}
@endsection

@section('post_thumbnail')
    <img src="/{{$news->thumbnail->specs->first()->file_fullpath}}" alt="{{$news->thumbnail->title}}">
@endsection

@section('text-area')
    {!! $news->post->content !!}
@endsection

@section('attachments')
    {{--@include('partials.attachments')--}}
@endsection


@section('related-posts')
    {{--@include('partials.related-posts')--}}
@endsection
