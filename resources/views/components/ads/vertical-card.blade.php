<div class="card mb-3 shadow h-100">
    <span class="notify-badge">{{$price}} €</span>
    <a href="{{$link}}"><img src="{{asset($image)}}" class="card-img-top" onerror="this.onerror=null; this.src='/img/no-image.png'" alt="{{$name}}"></a>
    <div class="card-body">
        <a href="{{$link}}">
            <h5 class="card-title">{{$name}}</h5>
        </a>
        <p class="card-text">{!!  $description !!}</p>
        <small class="text-muted">Ultima modificación: {{$lastUpdated}}</small>
    </div>
    <div class="card-footer text-center">
        <a href="{{$link}}" class="btn btn-block btn-lg btn-primary">Ir al anuncio</a>
    </div>
</div>
