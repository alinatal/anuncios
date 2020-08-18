<nav class="navbar navbar-expand-md navbar-dark bg-dark text-white shadow-sm pt-1 pb-1">
    <div class="container">
        <div class="col-md-4">
            <ul class="list-inline mb-0 pt-1 pb-1">
                <li class="list-inline-item"><span><i class="fa fa-envelope-o text-success mr-2"></i></span>
                    <a href="mailto://{{$email}}" class="success-link">{{$email}}</a>
                </li>
                <!--<li class="list-inline-item"><span><i class="fa fa-phone text-success mr-2"></i></span> <a href="tel:{{$phone}}" class="success-link">{{$phone}}</a></li>-->
                <li class="list-inline-item"><ul class="list-inline top-social">
                        <li class="list-inline-item"><a class="facebook text-decoration-none text-white" href="{{$facebook}}"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a class="twitter text-decoration-none text-white" href="{{$twitter}}"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a class="instagram text-decoration-none text-white" href="{{$instagram}}"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </li>
            </ul>
        </div>

            <div class="col-md-2 mt-1">
                <a href="{{route('ads.create')}}" class="btn btn-block btn-danger font-weight-bold">
                    <i class="fas fa-plus"></i> Publicar anuncio
                </a>
            </div>
            <div class="col-md-2 mt-1">
                <a href="{{route('category.index')}}" class="btn btn-block btn-success font-weight-bold">
                    <i class="fa fa-list"></i> Categorías
                </a>
            </div>

            <div class="col-md-2 mt-1">
                <a href="{{route('my-ads')}}" class="btn btn-block btn-info font-weight-bold">
                    <i class="fa fa-list"></i> Mis anuncios
                </a>
            </div>

            <div class="col-md-2 mt-1">
                <a href="{{route('fav.index')}}" class="btn btn-block btn-secondary font-weight-bold">
                    <i class="fa fa-star"></i> Mis favoritos
                </a>
            </div>













        {{--<div class="col-md-3">
            <a href="{{route('sponsor.create')}}" class="btn btn-block btn-primary">Contratar publicidad</a>
        </div>

        <div class="col-md-2 d-none d-md-block">
            <a href="{{route('ads.create')}}" class="btn  btn-block btn-success">Nuevo anuncio</a>
        </div>
        <div class="col-md-2 d-md-none mt-1">
            <a href="{{route('ads.create')}}" class="btn btn-block btn-success">Nuevo anuncio</a>
        </div>--}}
    </div>
</nav>

<nav class="navbar navbar-expand-md navbar-light shadow-sm pt-4 pb-4">
    <div class="container ">
        <a class="navbar-brand" href="{{ url($logoUrl) }}">
            <img src="{{$logo}}" height="60" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <x-list-item :list="config('settings.site_primary_menu')" :bullet="false" :navbar="true"></x-list-item>
            </ul>
        </div>
    </div>
</nav>









{{--<div id="bottom-menu" class="row">
    <div class="col-3 h6">
        Publicar anuncio
    </div>
    <div class="col-3 h6">
        Categorías
    </div>
    <div class="col-3 h6">
        Mis anuncios
    </div>
    <div class="col-3 h6">
        Mis favoritos
    </div>

</div>--}}

<footer class="footer">
    <div id="buttonGroup" class="btn-group selectors" role="group" aria-label="Basic example">
        <button onclick="location.href='{{route('ads.create')}}'" id="home" type="button" class="btn btn-secondary @if(request()->routeIs('ads.create')) button-active @else button-inactive @endif">
            <div class="selector-holder">
                <i class="fas fa-plus"></i>
                <span>Nuevo anuncio</span>
            </div>
        </button>
        <button onclick="location.href='{{route('category.index')}}'" id="feed" type="button" class="btn btn-secondary @if(request()->routeIs('category.index')) button-active @else button-inactive @endif">
            <div class="selector-holder">
                <i class="fa fa-list"></i>
                <span>Categorías</span>
            </div>
        </button>
        <button onclick="location.href='{{route('my-ads')}}'" id="create" type="button" class="btn btn-secondary @if(request()->routeIs('my-ads')) button-active @else button-inactive @endif">
            <div class="selector-holder">
                <i class="fa fa-list"></i>
                <span>Mis anuncios</span>
            </div>
        </button>
        <button onclick="location.href='{{route('fav.index')}}'" id="account" type="button" class="btn btn-secondary @if(request()->routeIs('fav.index')) button-active @else button-inactive @endif">
            <div class="selector-holder">
                <i class="fa fa-star"></i>
                <span>Mis Favoritos</span>
            </div>
        </button>
    </div>
</footer>


<style>
    .footer {
        position:fixed;
        bottom: 0;
        width: 100%;
        height: 60px;
        background-color: #f5f5f5;

        border-top: 1px solid transparent;
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);
        z-index: 9999999;
    }

    .selectors, .block{
        height:100%;
        width:100%;
    }

    .selectors button{
        border: 0;
        border-radius: 0;
        background-color: #f8f9fa !important;
        width:25%;
        margin-left: 0;
    }

    .selectors button:active{
        border:0;
    }

    .selectors button:focus{
        border:0;
        outline: 0;
        box-shadow: 0 0 0 0px;
    }

    .active, .selector-holder{
        display: flex;
        flex-direction: column;
    }

    .inactive{
        display: none;
    }

    .selector-holder span{
        font-size: 0.6rem;
    }

    /* Colors of the buttons*/
    .button-active, .selectors button:hover, .selectors button:active, .selectors button:focus{
        color: #ff0000;
    }

    .button-inactive{
        color: #000;
    }

    /*    #bottom-menu{
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 200px;
            line-height: 60px;
            background-color: #f5f5f5;
            z-index: 999;
        }*/
</style>
