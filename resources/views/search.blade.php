@extends('layouts.app')

    @section('title')
        @isset($search)
            Resultados de búsqueda para: {{$search}}
        @endisset
    @endsection

@section('content')

    <div class="mb-5 mt-5">
        @foreach($ads as $ad)
            <x-ad-card
                :link="route('ads.show', ['ad' => $ad->slug])"
                :image="json_decode($ad->images)"
                :name="$ad->name"
                :description="$ad->description"
                :lastUpdated="$ad->updated_at"
                :price="$ad->price"
            ></x-ad-card>
        @endforeach
    </div>
    @isset($search)
        {!! $ads->appends(['search'=>$search])->links() !!}
    @else
        {!! $ads !!}
    @endif
@endsection
