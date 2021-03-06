@extends('layouts.app')

@section('title', $category->name)

@section('meta-tags')
    @if($category->meta_title)
        <meta name="title" content="{{$category->meta_title}}">
    @endif
    @if($category->meta_description)
        <meta name="description" content="{{$category->meta_description}}">
    @endif
@endsection

@section('content')

    <x-breadcrumb
        :home="route('main')"
        :breadcrumbs="$parents"
        :postname="$category->name"
    ></x-breadcrumb>

    @foreach($category->children as $children)
        <a href="{{route('category.show', [$children->slug])}}" class="badge badge-pill badge-info text-white p-3">
            {{$children->name}}
        </a>
    @endforeach


    <form action="" id="price_filter" class="mt-5">
        <input type="hidden" id="min" name="min_price" readonly style="border:0; color:#f6931f; font-weight:bold;">
        <input type="hidden" id="max" readonly name="max_price" style="border:0; color:#f6931f; font-weight:bold;">

        <div id="slider-range">
            <div class="row mt-4">
                <div class="col-6" id="min-text">{{floor((Request::has('min_price') && strlen(Request::get('min_price'))) ? Request::get('min_price') : $min)}} €</div>
                <div class="col-6 text-right" id="max-text">{{ceil((Request::has('max_price') && strlen(Request::get('max_price'))) ? Request::get('max_price') : $max)}} €</div>
            </div>
        </div>
    </form>


    <div class="mb-5 mt-5">
    @if(!$ads->count())
            <div class="alert alert-warning" role="alert">
                @isset($min)
                    En el filtro de precio seleccionado no hay anuncios disponibles
                @else
                    Aun no hay anuncios en esta categoría
                @endif
            </div>
            <div class="card mb-3 mt-3">
                <div class="card-horizontal">
                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-interval="4000">
                        <div class="carousel-inner">
                            @foreach($sponsorCard->shuffle() as $key => $item)
                                @if($item->image && $item->image_sm)
                                    <div class="carousel-item {{(!$key) ? 'active' : ''}}">
                                        <a href="@if($item->link != null){{$item->link}}@else#@endif" @if($item->link != null) target="_blank" @endif>
                                            <picture>
                                                <source media="(min-width:768px)" srcset="{{secure_asset($item->image)}}">
                                                <img src="{{secure_asset($item->image_sm)}}" class="d-block w-100">
                                            </picture>                                            {{--@if($item->description != null)
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
    @foreach($ads as $key => $ad)

        @if(($key)%5 == 0)
                <div class="card mb-3 mt-3">
                    <div class="card-horizontal">
                        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-interval="4000">
                            <div class="carousel-inner">
                                @foreach($sponsorCard->shuffle() as $key => $item)
                                    @if($item->image && $item->image_sm)
                                        <div class="carousel-item {{(!$key) ? 'active' : ''}}">
                                            <a href="@if($item->link != null){{$item->link}}@else#@endif" @if($item->link != null) target="_blank" @endif>
                                                <picture>
                                                    <source media="(min-width:768px)" srcset="{{secure_asset($item->image)}}">
                                                    <img src="{{secure_asset($item->image_sm)}}" class="d-block w-100">
                                                </picture>                                              {{--@if($item->description != null)
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

            <x-ad-card
                :link="route('ads.show', ['ad' => $ad->slug])"
                :image="json_decode($ad->images)[0]"
                :name="$ad->name"
                :description="$ad->description"
                :lastUpdated="$ad->updated_at"
                :price="$ad->price"
            ></x-ad-card>

    @endforeach
    </div>

    {!!  $ads !!}





@endsection

@section('styles')
    <style src="{{asset('js/jquery-ui/jquery-ui.min.css')}}"></style>
    <style src="{{asset('js/jquery-ui/jquery-ui.structure.min.css')}}"></style>
    <style src="{{asset('js/jquery-ui/jquery-ui.theme.min.css')}}"></style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
        @media (max-width: 576px) {
            /* Supress pointer events */
            #slider-range { pointer-events: none; }
            /* Enable pointer events for slider handle only */
            #slider-range .ui-slider-handle { pointer-events: auto; }
        }


    </style>

@endsection


@section('scripts')

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>


    <script>
        $( function() {
            $( "#slider-range" ).slider({
                range: true,
                min: {{floor($min)}},
                max: {{ceil($max)}},
                values: [{{floor((Request::has('min_price') && strlen(Request::get('min_price'))) ? Request::get('min_price') : $min)}} , {{(ceil(Request::has('max_price') && strlen(Request::get('max_price')) ? Request::get('max_price') : $max))}} ],
                slide: function( event, ui ) {

                    $( "#max" ).val(ui.values[ 1 ]);
                    $( "#min" ).val(ui.values[ 0 ]);
                    $( "#max-text" ).html(ui.values[ 1 ]);
                    $( "#min-text" ).html(ui.values[ 0 ]);
                },
                stop: function(event, ui) {
                    $("#price_filter").submit();
                },
            });

            $( "#max-text" ).html(ui.values[ 1 ]);
            $( "#min-text" ).html(ui.values[ 0 ]);
        } );
    </script>
@endsection
