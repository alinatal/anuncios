@extends('layouts.admin')


@section('title')
    {{($method == 'update') ? 'Modificar' : 'Crear'}} Categoría
@endsection

@section('content')

    <form action="@isset($category){{ route('admin.category.'.$method, $category->slug)}}@else{{route('admin.category.'.$method)}} @endisset" method="POST" enctype="multipart/form-data">
        @method(($method == 'update')? 'PUT': 'POST')
        @csrf

        @if($method == 'store' && app()->get('request')->input('parent'))
            <input type="hidden" name="parent_id" value="{{app()->get('request')->input('parent')}}">
        @endif

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Introduzca el nombre de la categoría" value="@isset($category){{ $category->name}}@endisset" required>
        </div>
        <div class="form-group">
            <label for="meta_title">Nombre Alternativo</label>
            <input type="text" class="form-control" name="meta_title" id="meta_title" maxlength="60" placeholder="Nombre alternativo (meta-tags)" value="@isset($category){{ $category->meta_title}}@endisset">
        </div>
        <div class="form-group">
            <label for="meta_description">Descripción</label>
            <input type="text" class="form-control" name="meta_description" id="meta_description" maxlength="160" placeholder="Descripción de la categoría (meta-tags)" value="@isset($category){{ $category->meta_description}}@endisset">
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image">
                <label class="custom-file-label" for="customFile">Escoge una imagen</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{($method == 'update') ? 'Actualizar' : 'Crear'}} categoría</button>

    </form>


@endsection
