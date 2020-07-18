@extends('layouts.app')

@section('content')

    <x-breadcrumb
        :home="route('main')"
        :breadcrumbs="$parents"
        :postname="$category->name"
    ></x-breadcrumb>

    <h1>{{$category->name}}</h1>
    <hr>
    @foreach($category->children as $children)
        <a href="{{route('category', [$children->slug])}}" class="badge badge-pill badge-info text-white p-3">
            {{$children->name}}
        </a>
    @endforeach


    <div class="mb-5 mt-5">
    @foreach($ads as $ad)

            <x-horizontal-ad-card
                :link="route('ads.index', ['slug' => $ad->slug])"
                :image="json_decode($ad->images)[0]"
                :name="$ad->name"
                :description="$ad->description"
                :lastUpdated="$ad->updated_at"
                :price="$ad->price"
            ></x-horizontal-ad-card>

    @endforeach
    </div>

    {!!  $ads !!}
@endsection
