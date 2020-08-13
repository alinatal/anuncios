@extends('layouts.app')

@section('title', $page->name)

@section('meta-tags')
    @if($page->meta_title)
        <meta name="title" content="{{$page->meta_title}}">
    @endif
    @if($page->meta_description)
        <meta name="description" content="{{$page->meta_description}}">
    @endif
@endsection

@section('content')
    {!! $page->description !!}
@endsection
