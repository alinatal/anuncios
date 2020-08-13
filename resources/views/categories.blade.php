@extends('layouts.app')

@section('title', 'Categorías')

@section('content')
    <x-category-list :categories="$categories" :accordion="true" :route="'category.show'"></x-category-list>
@endsection
