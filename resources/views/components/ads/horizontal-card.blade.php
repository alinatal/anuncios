{{--
<div class="card mb-3">
    <div class="card-horizontal">
        <div class="img-square-wrapper">
            <a href="{{$link}}"><img src="{{asset($image)}}" onerror="this.onerror=null; this.src='/img/no-image.png'" alt="{{$name}}" width="200" height="200"></a>
        </div>
        <div class="card-body">
            <a href="{{$link}}"><h5 class="card-title">{{$name}}</h5></a>
            <p class="card-text">{!! $description !!}</p>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <p class="card-text col-5 "><small class="text-muted">Última modificación: {{$lastUpdated}}</small></p>
            @if($price)
            <h5 class="card-text col-5 text-right text-danger font-weight-bold">{{$price}} €</h5>
            @elseif($actions)
                <div class="d-flex justify-content-end col-5">

                    @foreach($actions as $key => $action)
                    <form action="{{$action['route']}}" @if(strtoupper($action['method']) != 'GET') method="POST" @endif>
                        @method($action['method'])
                        @csrf
                        <button class="{{$action['class']}} ml-1 mr-1">
                            @if(array_key_exists('fa-icon', $action))
                            <i class="{{$action['fa-icon']}}" aria-hidden="true"></i>
                            @endif
                            {{$key}}
                        </button>
                    </form>

                @endforeach
                </div>
            @endif
        </div>
    </div>

</div>
--}}

<div class="row border rounded m-0 shadow bg-white mt-4">
    <div class="col-md-3 p-0">
        <a href="{{$link}}">
            @if(true || $image != '/img/no-image.png')
            <img src="{{asset($image)}}" class="img-thumbnail w-100 border-0 bg-white" alt="{{$name}}" {{--onerror="this.onerror=null; this.src='{{asset('img/no-image.png')}}'"--}}>
            @endif
        </a>
        @if($price && ((float) $price) != 0.00)
        <span class="position-absolute bg-danger text-white p-2 rounded h6" style="right: 0px; top: 10px;">{{$price}} €</span>
        @endif
    </div>
    <div class="col-md-9 pt-4 pb-4">
        <a class="h4" href="{{$link}}">{{$name}}</a>
        <p class="text-muted small pt-1">Ultima actualización: {{$lastUpdated}}</p>
        <p class="text-muted">{!! $description !!}</p>
    </div>
    <div class="col-12 border-top pl-3 pr-3 pt-2 pb-2" style="background-color: #F7F7F7;">
        @if($actions)

            <div class="d-flex justify-content-end">
                <a href="{{$link}}" class="btn btn-primary">
                    <i class="fa fa-sign-in" aria-hidden="true"></i>
                    Ir al anuncio
                </a>

                @foreach($actions as $key => $action)
                    <form action="{{$action['route']}}" @if(strtoupper($action['method']) != 'GET') method="POST" @endif>
                        @method($action['method'])
                        @csrf
                        <button class="{{$action['class']}} ml-1 mr-1">
                            @if(array_key_exists('fa-icon', $action))
                                <i class="{{$action['fa-icon']}}" aria-hidden="true"></i>
                            @endif
                            {{$key}}
                        </button>
                    </form>

                @endforeach
            </div>
        @else
        <a href="{{$link}}" class="btn btn-primary btn-lg btn-block">Ir al anuncio</a>
        @endif
    </div>

</div>
