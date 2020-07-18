<div class="card mb-3">
    <div class="card-horizontal">
        <div class="img-square-wrapper">
            <a href="{{$link}}"><img src="{{$image}}" alt="{{$name}}" width="200" height="200"></a>
        </div>
        <div class="card-body">
            <a href="{{$link}}"><h5 class="card-title">{{$name}}</h5></a>
            <p class="card-text">{{$description}}</p>
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
