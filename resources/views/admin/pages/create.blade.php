@extends('layouts.admin')

@section('title')
    {{($method == 'update') ? 'Modificar' : 'Crear'}} Pagina
@endsection

@section('content')

    <form action="@isset($page){{ route('admin.pages.'.$method, $page->slug)}}@else{{route('admin.pages.'.$method)}} @endisset" method="POST">
        @method(($method == 'update')? 'PUT': 'POST')
        @csrf

        <div class="form-group">
            <label for="name">Título</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Introduzca el título de la página" value="@isset($page){{ $page->name}}@endisset" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" id="description" cols="30" rows="20" class="form-control">@isset($page){{ $page->description }}@endisset</textarea>
        </div>
        <div class="form-group">
            <label for="meta_title">Titulo Alternativo</label>
            <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Nombre alternativo (meta-tags)" maxlength="60" value="@isset($page){{ $page->meta_title}}@endisset">
        </div>
        <div class="form-group">
            <label for="meta_description">Meta Descripción</label>
            <input type="text" class="form-control" name="meta_description" id="meta_description" placeholder="Meta-Descripción de la categoría)" maxlength="160" value="@isset($page){{ $page->meta_description}}@endisset">
        </div>

        <button type="submit" class="btn btn-primary">{{($method == 'update') ? 'Actualizar' : 'Crear'}} página</button>

    </form>


@endsection

@section('scripts')
    <script src="https://cdn.tiny.cloud/1/0xmf4kd6fgzni5qvr3mc0ephfda1c2m8pc5dwgrirjxj4taf/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea'
        });
    </script>
@endsection
