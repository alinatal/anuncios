@extends('layouts.admin')

@section('title')
    {{($method == 'update') ? 'Modificar' : 'Crear'}} Patrocinador
@endsection

@section('content')

    <form action="@isset($sponsor){{ route('admin.sponsor.'.$method, $sponsor)}}@else{{route('admin.sponsor.'.$method)}} @endisset" method="POST" enctype="multipart/form-data">
        @method(($method == 'update')? 'PUT': 'POST')
        @csrf

        @if($method == 'store' && app()->get('request')->input('parent'))
            <input type="hidden" name="parent_id" value="{{app()->get('request')->input('parent')}}">
        @endif

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Introduzca el nombre del patrocinador" value="@isset($sponsor){{ $sponsor->name}}@endisset" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <input type="text" class="form-control" name="description" id="description" maxlength="160" placeholder="Descripción del patrocinador" value="@isset($sponsor){{ $sponsor->description}}@endisset">
        </div>

        <div class="form-group">
            <label for="link">Enlace</label>
            <input type="text" class="form-control" name="link" id="link" placeholder="Enlace del patrocinador" value="@isset($sponsor){{ $sponsor->link }}@endisset">
        </div>

        <div class="form-group">
            <label for="zone">Zona: </label>
            <select name="zone" id="zone" class="form-control">
                <option value="carousel" @if(isset($sponsor) && $sponsor->zone == 'carousel') selected @endif>Carrusel</option>
                <option value="ads" @if(isset($sponsor) && $sponsor->zone == 'ads') selected @endif>Anuncios</option>
                @foreach($categories as $category)
                    <option value="categories.{{$category->slug}}" @if(isset($sponsor) && $sponsor->zone == ('categories.'.$category->slug)) selected @endif>{{($category->parent) ? $category->parent->name.' > ': ''}}{{$category->name}}</option>
                @endforeach

{{--                <option value="categories" @if(isset($sponsor) && $sponsor->zone == 'categories') selected @endif>Categorías</option>--}}
            </select>
        </div>


        <div class="form-group">
            <label for="alternative">¿Anuncio alternativo?</label>
            <div class="custom-control custom-radio">
                <input type="radio" value=1 name="alternative" id="alternative-true" class="custom-control-input" @if(isset($sponsor) && $sponsor->alternative) checked @endif>
                <label for="alternative-true" class="custom-control-label">Si</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" value=0 name="alternative" id="alternative-false" class="custom-control-input" @if(isset($sponsor) && !$sponsor->alternative) checked @endif @if(!isset($sponsor)) checked @endif>
                <label for="alternative-false" class="custom-control-label">No</label>
            </div>
        </div>



        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image">
                <label class="custom-file-label" for="image">Escoge una imagen para ordenador</label>
            </div>
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="image_sm" name="image_sm">
                <label class="custom-file-label" for="image_sm">Escoge una imagen para móvil</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{($method == 'update') ? 'Actualizar' : 'Crear'}} patrocinador</button>

    </form>

@endsection
