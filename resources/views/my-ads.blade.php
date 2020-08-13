@extends('layouts.app')

@section('title', "Mis anuncios")

@section('content')

    @isset($ads)
        @if($ads->count())

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
                        'Modificar'=> [
                            'class' => 'btn btn-info',
                            'method' => 'PUT',
                            'fa-icon' => 'fa fa-pencil-square-o',
                            'route' => route('ads.editRequest', ['ad' => $ad->slug])
                        ],
                        'Eliminar'=> [
                            'class' => 'btn btn-danger',
                            'method' => 'DELETE',
                            'fa-icon' => 'fa fa-trash',
                            'route' => route('ads.destroyRequest', ['ad' => $ad->slug])
                        ],
                    ]"
                ></x-ad-card>

            @endforeach
        </div>

        {!! $ads->appends(['email'=>$email])->links() !!}
        @else

            <p class="alert alert-danger">No se encontraron anuncios para ese email.</p>

        @endif

    @else
        <form action="{{route('my-ads')}}">
            <div class="form-group row">
                <input type="email" name="email" class="form-control" placeholder="Introduzca su correo electrónico..." required>
                <button type="submit" class="btn btn-success btn-block mt-2">Buscar</button>
            </div>
        </form>
    @endif

@endsection
