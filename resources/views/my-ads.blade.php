@extends('layouts.app')

@section('content')
    @isset($ads)

        <div class="mb-5 mt-5">
            <h1>Anuncios de "{{$email}}"</h1>

            @foreach($ads as $ad)

                <x-horizontal-ad-card
                    :link="route('ads.index', ['slug' => $ad->slug])"
                    :image="json_decode($ad->images)[0]"
                    :name="$ad->name"
                    :description="$ad->description"
                    :lastUpdated="$ad->updated_at"
                    :actions="[
                        'Modificar'=> [
                            'class' => 'btn btn-info',
                            'method' => 'PUT',
                            'fa-icon' => 'fa fa-pencil-square-o',
                            'route' => route('main')
                        ],
                        'Eliminar'=> [
                            'class' => 'btn btn-danger',
                            'method' => 'DELETE',
                            'fa-icon' => 'fa fa-trash',
                            'route' => route('main')
                        ],
                    ]"
                ></x-horizontal-ad-card>

            @endforeach
        </div>

        {!! $ads->appends(['email'=>$email])->links() !!}
    @else
        <h1>Mis anuncios</h1>


        <form action="{{route('my-ads')}}">
            <div class="form-group row">
                <input type="email" name="email" class="form-control" placeholder="Introduzca su correo electrónico..." required>
                <button type="submit" class="btn btn-success btn-block mt-2">Buscar</button>
            </div>

        </form>
    @endif

@endsection
