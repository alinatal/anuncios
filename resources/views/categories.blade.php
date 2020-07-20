@extends('layouts.app')

@section('content')

    <h1>Categorías</h1>

    <div class="card p-5 mt-3">
        <x-category-list :categories="$categories"></x-category-list>
    </div>



@endsection
