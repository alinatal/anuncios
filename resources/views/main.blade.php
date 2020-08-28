@extends('layouts.app')

@section('meta-tags')
    @if(config('settings.site_name'))
        <meta name="title" content="{{config('settings.site_description')}}">
    @endif
    @if(config('settings.site_description'))
        <meta name="description" content="{{config('settings.site_description')}}">
    @endif
@endsection

@section('content')

<div class="mb-5">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-interval="4000">
            <div class="carousel-inner">
                @foreach($carousel as $key => $item)
                    @if($item->image && $item->image_sm)
                        <div class="carousel-item {{(!$key) ? 'active' : ''}}">
                            @if($item->link != null)
                                <a href="{{$item->link}}" target="_blank">
                            @endif


                            <picture>
                                <source media="(min-width:768px)" srcset="{{secure_asset($item->image)}}">
                                <img src="{{secure_asset($item->image_sm)}}" class="d-block w-100">
                            </picture>

                                        {{--@if($item->description != null)
                                            <div class="carousel-caption d-none d-md-block bg-dark text-white rounded-pill" style="opacity: 0.7">
                                                <h5><a href="@if($item->link != null){{$item->link}}@else#@endif">{{$item->name}}</a></h5>
                                                <p>{{$item->description}}</p>
                                            </div>
                                        @endif--}}
                            @if($item->link != null)
                                </a>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
</div>

@include('components.search')

{{--
<div class="row text-center">
    <div class="col-md-3 mt-3">
        <a href="{{route('ads.create')}}" class="btn btn-block btn-outline-danger font-weight-bold">
            <i class="fas fa-plus"></i> Publicar anuncio
        </a>
    </div>
    <div class="col-md-3 mt-3">
        <a href="{{route('category.index')}}" class="btn btn-block btn-outline-success font-weight-bold">
            <i class="fa fa-list"></i> Categorías
        </a>
    </div>

    <div class="col-md-3 mt-3">
        <a href="{{route('my-ads')}}" class="btn btn-block btn-outline-info font-weight-bold">
            <i class="fa fa-list"></i> Mis anuncios
        </a>
    </div>

    <div class="col-md-3 mt-3">
        <a href="{{route('fav.index')}}" class="btn btn-block btn-outline-secondary font-weight-bold">
            <i class="fa fa-star"></i> Mis favoritos
        </a>
    </div>

</div>
--}}

{{--<div class="row">--}}
{{--    <div class="col-12 mt-5">--}}
{{--        <h2 class="text-muted mb-4">Categorías</h2>--}}

{{--        <div class="row row-cols-1 row-cols-md-4">--}}
{{--        @foreach($categories as $category)--}}
{{--            <div class="col mb-5">--}}
{{--                <div class="card shadow h-100">--}}
{{--                    <a href="{{route('category.show', ['category' => $category->slug])}}"><img src="{{$category->image}}" onerror="this.onerror=null; this.src='/img/no-image.png'" class="card-img-top" alt=""></a>--}}
{{--                    <div class="card-body">--}}
{{--                        <a href="{{route('category.show', ['category' => $category->slug])}}" class="text-decoration-none text-dark"><h5 class="card-title text-center">{{$category->name}}</h5></a>--}}
{{--                        <ul class="list-inline">--}}
{{--                            @foreach($category->children as $children)--}}
{{--                                <li class="list-inline-item">--}}
{{--                                    <h4><a href="{{route('category.show', ['category' => $children->slug])}}" class="badge badge-pill badge-info text-white">{{$children->name}}</a></h4>--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</div>--}}

<div class="row">
    <div class="col-12 mt-5">
        <h2 class="text-muted mb-4">Últimos anuncios</h2>

{{--        <div class="row row-cols-1 row-cols-md-4">--}}
        @if(!$ads->count())
            Aun no hay anuncios
        @endif
        @foreach($ads as $key => $ad)

                @if(($key+1)%5 == 0 && $key != 0)
                    <div class="col mb-3 mt-3">

                        <div class="card mb-3 shadow h-100">

                            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-interval="4000">
                                <div class="carousel-inner">
                                    @foreach($sponsorCard->shuffle() as $key => $item)
                                        @if($item->image && $item->image_sm)
                                        <div class="carousel-item {{(!$key) ? 'active' : ''}}">
                                            <a href="@if($item->link != null){{$item->link}}@else#@endif" @if($item->link!=null) target="_blank"@endif>
                                                    <picture>
                                                        <source media="(min-width:768px)" srcset="{{secure_asset($item->image)}}">
                                                        <img src="{{secure_asset($item->image_sm)}}" class="d-block w-100">
                                                    </picture>
{{--                                                <img src="{{$item->image}}" class="d-block w-100" alt="{{$item->name}}">--}}
                                                {{--@if ($item->description != null)
                                                <div class="carousel-caption d-none d-md-block bg-dark text-white rounded" style="opacity: 0.7">
                                                    <h5><a href="@if($item->link != null){{$item->link}}@else#@endif">{{$item->name}}</a></h5>
                                                    <p>{{$item->description}}</p>
                                                </div>
                                                @endif--}}
                                            </a>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                @endif



                <div class="col mb-3">
                <x-ad-card
                    :link="route('ads.show', ['ad' => $ad->slug])"
                    :image="json_decode($ad->images)"
                    :name="$ad->name"
                    :description="$ad->description"
                    :lastUpdated="$ad->updated_at"
                    :price="$ad->price"
                    :type="'horizontal'"
                ></x-ad-card>
            </div>
        @endforeach
{{--        </div>--}}
    </div>
</div>


{!! $ads !!}

@endsection

@section('styles')
    <style>
        .pagination {
            display: -ms-flexbox;
            flex-wrap: wrap;
            display: flex;
            padding-left: 0;
            list-style: none;
            border-radius: 0.25rem;
        }
    </style>
@endsection
