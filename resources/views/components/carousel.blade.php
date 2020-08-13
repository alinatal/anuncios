<div id="carouselExampleIndicators" class="carousel slide rounded card-img-top" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($images as $key => $image)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class="{{(!$key) ? 'active' : ''}}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach($images as $key => $image)
            <div class="carousel-item {{(!$key) ? 'active' : ''}}">
                <img src="{{asset($image)}}" class="d-block w-100 rounded" onerror="this.onerror=null; this.src='/img/no-image.png'">
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
    </a>
</div>
