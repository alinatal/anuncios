@extends('layouts.admin')

@section('title', 'Anuncios')

@section('action')
    <form action="" id="form-order" class="form-group d-inline-flex">
        <select name="order" id="select" class="form-control-sm mr-2">
            <option value="">Ordenar por referencia</option>
            <option value="category_id" @if(Request::has('order') && Request::get('order') == 'category_id') selected @endif>Ordenar por categoría</option>
            <option value="updated_at" @if(Request::has('order') && Request::get('order') == 'updated_at') selected @endif>Ordenar por fecha</option>
        </select>
        <input type="hidden" name="page" value="@if(app()->get('request')->input('page')){{app()->get('request')->input('page')}}@endif">
        <input type="text" name="search" placeholder="Busca titulo, texto o ref." class="form-control-sm" width="100">
    </form>

@endsection

@section('content')

    @if($ads->count())
        <div class="table-responsive">
            <table class="table table-striped bg-white table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Título</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ads as $ad)
                    <tr>
                        <th scope="row">{{$ad->id}}</th>
                        @if($ad->images && sizeof(json_decode($ad->images)))
                            <td><img src="{{asset(json_decode($ad->images)[0])}}" class="img-thumbnail" width="100px" alt=""></td>
                        @else
                            <td><img src="{{asset('img/no-image.png')}}" class="img-thumbnail" width="100px" alt=""></td>
                        @endif
                        <td>{{$ad->name}}</td>
                        <td>{{$ad->price}} €</td>
                        <td>{{$ad->category->name}}</td>
                        <td>{{$ad->user->name}}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <a href="{{route('ads.show',$ad->slug)}}" target="_blank" class="btn btn-primary btn-block">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </div>


                                <div class="col-md-4 mt-2">
                                    <a href="{{$ad->getURL('edit')}}" target="_blank" class="btn btn-secondary btn-block">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>

                                </div>
                                <div class="col-md-4 mt-2">
                                    <form action="{{route('admin.ad.destroy', $ad->slug)}}" method="POST">
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

        {!! $ads->appends(request()->input())->links() !!}
    @else
        <p class="text-muted">No se encontraron anuncios</p>
    @endif

@endsection

@section('scripts')
    <script>
        $('#select').on('change', function () {
            $('#form-order').submit();
        });
    </script>
@endsection
