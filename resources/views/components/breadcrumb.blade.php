<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{$home}}" class="breadcrumb-item">Inicio</a></li>
        @foreach($breadcrumbs as $breadcrumb)
            @if($slug)
                <li class="breadcrumb-item"><a href="{{route($route, ['category' => $breadcrumb->slug])}}">{{$breadcrumb->name}}</a></li>
            @else
                <li class="breadcrumb-item"><a href="{{route($route, ['id' => $breadcrumb->id])}}">{{$breadcrumb->name}}</a></li>
            @endif
        @endforeach
        <li class="breadcrumb-item active" aria-current="page">{{$postname}}</li>
    </ol>
</nav>
