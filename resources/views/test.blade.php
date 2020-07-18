@extends('layouts.app')

@section('content')

    @foreach($test as $item)
        {{print_r($item)}}
    @endforeach

@endsection
