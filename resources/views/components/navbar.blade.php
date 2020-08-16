<nav class="navbar navbar-expand-md navbar-dark bg-dark text-white shadow-sm pt-1 pb-1">
    <div class="container">
        <div class="col-md-7">
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
        <div class="col-md-3">
            <a href="{{route('sponsor.create')}}" class="btn btn-block btn-primary">Contratar publicidad</a>
        </div>
        <div class="col-md-2 d-none d-md-block">
            <a href="{{route('ads.create')}}" class="btn  btn-block btn-success">Nuevo anuncio</a>
        </div>
        <div class="col-md-2 d-md-none mt-1">
            <a href="{{route('ads.create')}}" class="btn btn-block btn-success">Nuevo anuncio</a>
        </div>
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
