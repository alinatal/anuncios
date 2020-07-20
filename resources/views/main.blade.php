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
                    <a href="{{route('category.show', ['slug' => $category->slug])}}"><img src="{{$category->image}}" onerror="this.onerror=null; this.src='/img/no-image.png'" class="card-img-top" alt=""></a>
                    <div class="card-body">
                        <a href="{{route('category.show', ['slug' => $category->slug])}}" class="text-decoration-none text-dark"><h5 class="card-title text-center">{{$category->name}}</h5></a>
                        <ul class="list-inline">
                            @foreach($category->children as $children)
                                <li class="list-inline-item">
                                    <h4><a href="{{route('category.show', ['slug' => $children->slug])}}" class="badge badge-pill badge-info text-white">{{$children->name}}</a></h4>
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

        <div class="row row-cols-1 row-cols-md-4">
        @foreach($ads as $ad)
            <div class="col mb-3">
                <x-ad-card
                    :link="route('ads.show', ['slug' => $ad->slug])"
                    :image="json_decode($ad->images)"
                    :name="$ad->name"
                    :description="$ad->description"
                    :lastUpdated="$ad->updated_at"
                    :price="$ad->price"
                    :type="'vertical'"
                ></x-ad-card>
            </div>
        @endforeach
        </div>
    </div>
</div>







@endsection
