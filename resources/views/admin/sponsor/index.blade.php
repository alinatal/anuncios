@extends('layouts.admin')

@section('title', 'Patrocinadores')
@section('action')
    <a class="btn btn-sm btn-primary ml-3" href="{{route('admin.sponsor.create')}}">Añadir patrocinador</a>
    <form action="" id="form-order" class="form-group d-inline-flex">
        <select name="order" id="select" class="form-control-sm mr-2">
            <option value="">Ordenar por referencia</option>
            <option value="name" @if(Request::has('order') && Request::get('order') == 'name') selected @endif>Ordenar por nombre</option>
            <option value="zone" @if(Request::has('order') && Request::get('order') == 'zone') selected @endif>Ordenar por zona</option>
        </select>
        <!--<input type="text" name="search" placeholder="Busca titulo, texto o ref." class="form-control-sm" width="100">-->
    </form>
@endsection

@section('content')
    @if($sponsors->count())
        <div class="table-responsive">
            <table class="table table-striped bg-white table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Imagen Móvil</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col"><p class="m-0 text-center">Zona</p></th>
                    <th scope="col">Alternativa</th>
{{--                    <th scope="col">Link</th>--}}
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sponsors as $sponsor)
                    <tr>
                        <th scope="row">{{$sponsor->id}}</th>
                        <td><a href="@if(strlen($sponsor->link)){{$sponsor->link}}@else#@endif" @if(strlen($sponsor->link))target="_blank"@endif><img src="@if($sponsor->image){{secure_asset($sponsor->image)}}@else{{secure_asset('img/no-image.png')}}@endif" alt="{{$sponsor->name}}" class="img-thumbnail" width="80"></a></td>
                        <td><a href="@if(strlen($sponsor->link)){{$sponsor->link}}@else#@endif"  @if(strlen($sponsor->link))target="_blank" @endif><img src="@if($sponsor->image_sm){{secure_asset($sponsor->image_sm)}}@else{{secure_asset('img/no-image.png')}}@endif" alt="{{$sponsor->name}}" class="img-thumbnail" width="80"></a></td>
                        <td>{{$sponsor->name}}</td>
                        <td>{{Str::limit($sponsor->description, $limit = 20, $end = '...')}}</td>
                        <td>
                            @if($sponsor->zone == 'ads')
                                <p class="m-0 text-center">Anuncios</p>
                            @elseif($sponsor->zone == 'carousel')
                                <p class="m-0 text-center">Carrusel</p>
                            @else
                                @php($zone = \App\Category::where('slug', explode('.', $sponsor->zone)[1])->first())
                                <p class="text-center m-0">@if($zone->parent) <small class="text-warning text-center">{{$zone->parent->name}}</small> <br>@endif {{$zone->name}}</p>

                            @endif
                        </td>
                        <td>{{($sponsor->alternative) ? 'Si' : 'No'}}</td>
{{--                        <td><a href="{{$sponsor->link}}">{{Str::limit($sponsor->link, $limit = 20, $end = '...')}}</a></td>--}}
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{route('admin.sponsor.edit', $sponsor->id)}}" class="btn btn-secondary btn-block">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>

                                </div>
                                <div class="col-md-6">
                                    <form action="{{route('admin.sponsor.destroy', $sponsor->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button  class="btn btn-danger btn-block">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

        {{$sponsors->appends(request()->input())->links()}}
    @else
        <p class="text-muted">No se encontraron patrocinadores.</p>
    @endif
@endsection

@section('scripts')
    <script>
        $('#select').on('change', function () {
            $('#form-order').submit();
        });
    </script>
@endsection
