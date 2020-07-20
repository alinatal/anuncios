@extends('layouts.app')

@section('content')

    <x-breadcrumb
        :home="route('main')"
        :breadcrumbs="$categories"
        :postname="$ad->name"
    ></x-breadcrumb>

    <div class="row">
        <div class="col-md-8 mb-3">
            <div class="card">
                <span class="notify-badge">{{$ad->price}} €</span>
                <x-carousel :images="$images"></x-carousel>

                <div class="card-body">
                    <span><i class="fa fa-clock-o mr-2"></i>{{$ad->updated_at->format('d/m/Y H:i:s')}}</span>
                    <hr>
                    <h2 class="card-title">{{$ad->name}}</h2>
                    <h4 class="card-title">Descripción</h4>
                    <p class="card-text">{!! $ad->description !!}</p>
                    <h4 class="card-title">Información adicional</h4>
                    <ul>
                        <li>Uno</li>
                        <li>Uno</li>
                        <li>Uno</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Información del vendedor</h5>
                    <hr>
                    <ul>
                        <li>Nombre: {{$user->name}}</li>
                        <li>Teléfono: <a href="tel:{{$user->phone}}">{{$user->phone}}</a></li>
                    </ul>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Acciones</h5>
                    <hr>
                    <a href="https://wa.me/{{str_replace([' ', '+'], '', $user->phone)}}?text=Me%20interesa%20el%20auto%20que%20estás%20vendiendo" target="_blank" class="btn btn-success btn-block mt-2">Enviar WhatsApp</a>
                    <a href="tel:{{$user->phone}}" class="btn btn-dark btn-block mt-2">Llamar por teléfono</a>
                    <a href="mailto:{{$user->email}}" class="btn btn-info btn-block mt-2">Enviar correo</a>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Ubicación</h5>
                    <hr>
                    <iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q={{urlencode($ad->location)}}&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                    <p class="card-text">{{$ad->location}}</p>
                    <a href="https://www.google.com/maps/search/{{urlencode($ad->location)}}" target="_blank" class="btn btn-success btn-block mt-2">Ver en el mapa</a>
                </div>
            </div>

        </div>
    </div>
   {{-- <div class="row">
        <div class="col-md-4">
            <div id="carouselExampleIndicators" class="carousel slide rounded" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    @foreach(json_decode($ad->images) as $key => $image)
                        <div class="carousel-item {{(!$key) ? 'active' : ''}}">
                            <img src="{{$image}}" class="d-block w-100 rounded" alt="...">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-8">
            <h1>{{$ad->name}}</h1>
            <p>{{$ad->description}}</p>
            <h1 class="text-right text-danger">{{$ad->price}} €</h1>
        </div>
    </div>

    <div class="mt-5 row">
        <div class="col-md-4">
            <h4>Datos del anunciante:</h4>
            <ul>
                <li>Nombre: {{$user->name}}</li>
                <li>Teléfono: <a href="tel:{{$user->phone}}">{{$user->phone}}</a></li>
            </ul>
        </div>
        <div class="col-md-8">
            <h4>Acciones:</h4>
            <div class="row">
                <div class="col-md-4">
                    <a href="https://wa.me/{{str_replace([' ', '+'], '', $user->phone)}}?text=Me%20interesa%20el%20auto%20que%20estás%20vendiendo" target="_blank" class="btn btn-success btn-block mt-2">Enviar WhatsApp</a>
                </div>
                <div class="col-md-4">
                    <a href="tel:{{$user->phone}}" class="btn btn-dark btn-block mt-2">Llamar por teléfono</a>
                </div>
                <div class="col-md-4">
                    <a href="mailto:{{$user->email}}" class="btn btn-info btn-block mt-2">Enviar correo</a>
                </div>
            </div>
        </div>


        <div class="row">

        </div>
    </div>--}}



@endsection
