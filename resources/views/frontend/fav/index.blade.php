@extends('layouts.app')

@section('title', "Mis favoritos")

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
                    :actions="[
                        'Eliminar de favoritos'=> [
                            'class' => 'btn btn-danger',
                            'method' => 'DELETE',
                            'fa-icon' => 'fa fa-trash',
                            'route' => route('fav.destroy', ['ad' => $ad])
                        ],
                    ]"

                ></x-ad-card>

        @endforeach
    </div>


        {!! $ads !!}

@endsection
