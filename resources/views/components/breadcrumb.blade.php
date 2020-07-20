<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{$home}}" class="breadcrumb-item">Inicio</a></li>
        @foreach($breadcrumbs as $breadcrumb)
            <li class="breadcrumb-item"><a href="{{route('category.show', ['slug' => $breadcrumb->slug])}}">{{$breadcrumb->name}}</a></li>
        @endforeach
        <li class="breadcrumb-item active" aria-current="page">{{$postname}}</li>
    </ol>
</nav>
