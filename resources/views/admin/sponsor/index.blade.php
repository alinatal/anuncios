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
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Zona</th>
                    <th scope="col">Alternativa</th>
                    <th scope="col">Link</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sponsors as $sponsor)
                    <tr>
                        <th scope="row">{{$sponsor->id}}</th>
                        <td><img src="{{asset($sponsor->image)}}" alt="{{$sponsor->name}}" class="img-thumbnail" width="80"></td>
                        <td>{{$sponsor->name}}</td>
                        <td>{{Str::limit($sponsor->description, $limit = 20, $end = '...')}}</td>
                        <td>
                            @if($sponsor->zone == 'ads')
                                Anuncios
                            @elseif($sponsor->zone == 'carousel')
                                Carrusel
                            @else
                                {{\App\Category::where('slug', explode('.', $sponsor->zone)[1])->first()->name}}
                            @endif
                        </td>
                        <td>{{($sponsor->alternative) ? 'Si' : 'No'}}</td>
                        <td><a href="{{$sponsor->link}}">{{Str::limit($sponsor->link, $limit = 20, $end = '...')}}</a></td>
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
