@extends('layouts.app')

@section('content')


<div class="mb-5">
    <img src="img/banner.jpg" class="img-fluid" width="100%" alt="">
</div>

@include('components.search')

<div class="row text-center">
    <div class="col-md-6 mt-3">
        <a href="{{route('ads.create')}}" class="btn btn-block btn-outline-danger font-weight-bold">
            <i class="fas fa-plus"></i> Publicar anuncio
        </a>
    </div>
    <div class="col-md-6 mt-3">
        <a href="{{route('my-ads')}}" class="btn btn-block btn-outline-info font-weight-bold">
            <i class="fa fa-list"></i> Mis anuncios
        </a>
    </div>

    {{--<div class="col-md-4 mt-3">
        <a href="#" class="btn btn-block btn-outline-success font-weight-bold">
            <i class="fa fa-star"></i> Mis favoritos
        </a>
    </div>--}}

</div>

<div class="row">
    <div class="col-12 mt-5">
        <h2 class="text-muted mb-4">Categorías</h2>

        <div class="row row-cols-2 row-cols-md-4">
        @foreach($categories as $category)
            <div class="col mb-5">
                <div class="card shadow h-100">
                    <a href="{{route('category', ['slug' => $category->slug])}}"><img src="{{$category->image}}" class="card-img-top" alt=""></a>
                    <div class="card-body">
                        <a href="{{route('category', ['slug' => $category->slug])}}" class="text-decoration-none text-dark"><h5 class="card-title text-center">{{$category->name}}</h5></a>
                        <ul class="list-inline">
                            @foreach($category->children as $children)
                                <li class="list-inline-item">
                                    <h4><a href="{{route('category', ['slug' => $children->slug])}}" class="badge badge-pill badge-info text-white">{{$children->name}}</a></h4>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
        </div>

    </div>
</div>

<div class="row">
    <div class="col-12 mt-5">
        <h2 class="text-muted mb-4">Últimos anuncios</h2>

        <div class="row row-cols-2 row-cols-md-4">
        @foreach($ads as $ad)
            <div class="col mb-5">
                <div class="card shadow h-100">
                    <a href="{{route('ads.index', ['slug' => $ad->slug])}}"><img src="{{json_decode($ad->images)[0]}}" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <a href="{{route('ads.index', ['slug' => $ad->slug])}}">
                            <h5 class="card-title">{{$ad->name}}</h5>
                        </a>
                        <h5 class="card-subtitle mb-2 text-danger text-right">{{$ad->price}}€</h5>
                        <p class="card-text">{{\Illuminate\Support\Str::limit($ad->description, $limit = 250, $end = '...')}}</p>
                        <small class="text-muted">Hace 3 mins</small>
                        <small class="text-danger"></small>
                    </div>
                    <div class="card-footer text-center">
                        {{--<small class="text-white bg-info pt-2 pb-2 rounded text-right col-6">Hace 3 mins</small>
                        <small class="text-white bg-danger pt-2 pb-2 rounded text-right col-6">{{$ad->price}} €</small>--}}
                        <a href="{{route('ads.index', ['slug' => $ad->slug])}}" class="btn btn-block btn-lg btn-primary">Ir al anuncio</a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>







@endsection
