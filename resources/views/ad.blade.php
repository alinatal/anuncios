@extends('layouts.app')
@section('title', $ad->name.' #'.$ad->id)

@section('meta-tags')
    <meta property="og:url"                content="{{url()->current()}}" />
    <meta property="og:type"               content="website" />
    <meta property="og:title"              content="{{$ad->name}}" />
    <meta property="og:description"        content="{{\Illuminate\Support\Str::words($ad->description, 20)}}" />
    <meta property="og:image"              content="{{secure_asset($images[0])}}" />
    <meta property="og:locale"              content="es_ES" />
@endsection

@section('content')
    <x-breadcrumb
        :home="route('main')"
        :breadcrumbs="$categories"
        :postname="$ad->name"
    ></x-breadcrumb>

    <div class="row">
        <div class="col-md-8 mb-3">
            <div class="card">
                @if(((float) $ad->price ) != 0.00)<span class="notify-badge">{{$ad->price}} €</span>@endif
                @if(($images)[0] != '/img/no-image.png')<x-carousel :images="$images"></x-carousel>@endif

                <div class="card-body">
                    <span><i class="fa fa-clock-o mr-2"></i>{{$ad->updated_at->format('d/m/Y H:i:s')}}</span>
                    <hr>
                    <h2 class="card-title">{{$ad->name}} | #{{$ad->id}}</h2>
                    <h4 class="card-title">Descripción</h4>
                    <p class="card-text">{!! $ad->description !!}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Información del vendedor</h5>
                    <hr>
                    <ul>
                        <li>Nombre: {{$user->name}}</li>
                        @if($user->phone)
                        <li>Teléfono: <a href="tel:{{$user->phone}}">{{$user->phone}}</a></li>
                        @endif
                        <li class="badge badge-pill @if($ad->seller_type == 'profesional') badge-warning @else badge-secondary @endif">Anuncio {{ucfirst($ad->seller_type)}}</li>
                    </ul>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Acciones</h5>
                    <hr>
                    @if($user->phone)
                    <a href="https://wa.me/{{(substr($user->phone, 0, 1) != '+') ? '+34'.$user->phone : $user->phone}}?text={{urlencode('Hola, Estoy interesado en este anuncio '.URL::current())}}" target="_blank" class="btn btn-success btn-block mt-2">Enviar WhatsApp</a>
                    <a href="tel:{{$user->phone}}" class="btn btn-dark btn-block mt-2 d-sm-none">Llamar por teléfono</a>
                    @endif
                    <a href="mailto:{{$user->email}}" class="btn btn-info btn-block mt-2">Enviar correo</a>
                    <a href="{{route('fav.store', $ad)}}" class="btn btn-secondary btn-block mt-2">Añadir a favoritos</a>
                    <button type="button" class="btn btn-danger btn-block mt-2" data-toggle="modal" data-target="#exampleModal">
                        Denunciar
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{route('report', $ad)}}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Denuncia del anuncio "{{$ad->name}}"</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <textarea type="text" name="reason" placeholder="Cuentanos tus motivos" class="form-control" rows="10"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-danger">Realizar denuncia</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Compartir</h5>
                    <hr>
                    <a href="https://wa.me/?text={{urlencode('Hola, ¡mira el anuncio que acabo de encontrar! Quizá te interese. '.URL::current())}}" target="_blank" class="btn btn-success btn-block mt-2">
                        <i class="fa fa-whatsapp" aria-hidden="true"></i>  WhatsApp
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(URL::current())}}&quote={{urlencode('Hola, ¡mira el anuncio que acabo de encontrar! Quizá te interese.')}}" target="_blank" class="btn btn-dark btn-block mt-2">

                        <i class="fa fa-facebook" aria-hidden="true"></i>  Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?via=anuncioslucena&text={{urlencode('Mira que anuncio acabo de encontrar: '.URL::current())}}" target="_blank" class="btn btn-info btn-block mt-2">
                        <i class="fa fa-twitter" aria-hidden="true"></i>  Twitter
                    </a>
                </div>
            </div>
            @if($ad->location)
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Ubicación</h5>
                    <hr>
                    <iframe width="100%" height="530" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q={{urlencode($ad->location)}}&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                    <p class="card-text">{{$ad->location}}</p>
                    <a href="https://www.google.com/maps/search/{{urlencode($ad->location)}}" target="_blank" class="btn btn-success btn-block mt-2">Ver en el mapa</a>
                </div>
            </div>
            @endif


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
