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

    @if($ads->count())

    <form action="" id="price_filter" class="mt-5">
        <input type="hidden" id="min" name="min_price" readonly style="border:0; color:#f6931f; font-weight:bold;">
        <input type="hidden" id="max" readonly name="max_price" style="border:0; color:#f6931f; font-weight:bold;">

        <div id="slider-range">
            <div class="row mt-4">
                <div class="col-6" id="min-text">{{round((Request::has('min_price') && strlen(Request::get('min_price'))) ? Request::get('min_price') : $min)-1}} €</div>
                <div class="col-6 text-right" id="max-text">{{round((Request::has('max_price') && strlen(Request::get('max_price'))) ? Request::get('max_price') : $max)+1}} €</div>
            </div>
        </div>
    </form>
    @endif


    <div class="mb-5 mt-5">
    @if(!$ads->count())
        Aun no hay anuncios en esta categoría
    @endif
    @foreach($ads as $key => $ad)

        @if(($key)%5 == 0)
                <div class="card mb-3 mt-3">
                    <div class="card-horizontal">
                        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-interval="4000">
                            <div class="carousel-inner">
                                @foreach($sponsorCard->shuffle() as $key => $item)
                                    <div class="carousel-item {{(!$key) ? 'active' : ''}}">
                                        <a href="@if($item->link != null){{$item->link}}@else#@endif" @if($item->link != null) target="_blank" @endif>
                                            <img src="{{$item->image}}" class="d-block w-100" alt="...">
                                            {{--@if($item->description != null)
                                            <div class="carousel-caption d-none d-md-block bg-dark text-white rounded" style="opacity: 0.7">
                                                <h5><a href="@if($item->link != null){{$item->link}}@else#@endif">{{$item->name}}</a></h5>
                                                <p>{{$item->description}}</p>
                                            </div>
                                            @endif--}}
                                        </a>
                                    </div>
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

@endsection

@section('scripts')

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>


    <script>
        $( function() {
            $( "#slider-range" ).slider({
                range: true,
                min: {{round($min)-1}},
                max: {{round($max)+1}},
                values: [{{round((Request::has('min_price') && strlen(Request::get('min_price'))) ? Request::get('min_price') : $min) -1}} , {{(round(Request::has('max_price') && strlen(Request::get('max_price')) ? Request::get('max_price') : $max))+1}} ],
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
