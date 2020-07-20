@extends('layouts.app')

@section('content')

    <h1>Resultados de búsqueda para: "{{$search}}"</h1>

    <div class="mb-5 mt-5">
        @foreach($ads as $ad)

            <x-ad-card
                :link="route('ads.show', ['slug' => $ad->slug])"
                :image="json_decode($ad->images)[0]"
                :name="$ad->name"
                :description="$ad->description"
                :lastUpdated="$ad->updated_at"
                :price="$ad->price"
            ></x-ad-card>

        @endforeach
    </div>

    {!! $ads->appends(['search'=>$search])->links() !!}

@endsection
