@extends('layouts.admin')

@section('title')
    {{($method == 'update') ? 'Modificar' : 'Crear'}} Usuario
@endsection

@section('content')

    <form action="@isset($user){{ route('admin.user.'.$method, $user->id)}}@else{{route('admin.user.'.$method)}} @endisset" method="POST">
        @method(($method == 'update')? 'PUT': 'POST')
        @csrf

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nombre completo" value="@isset($user){{ $user->name}}@endisset" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Correo electrónico" value="@isset($user){{ $user->email}}@endisset" required>
        </div>
        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Teléfono" value="@isset($user){{ $user->phone}}@endisset" required>
        </div>
        <div class="form-group mt-5 mb-5">
            <h5>Tipo de usuario:</h5>
            <label for="admin-0">Usuario normal</label>
            <input type="radio" name="admin" value="0" id="admin-0" @isset($user){{($user->admin == 0) ? 'checked' : ''}}@endisset>
            <label for="admin-1" class="ml-5">Administrador</label>
            <input type="radio" name="admin" value="1" id="admin-1" @isset($user){{($user->admin == 1) ? 'checked' : ''}}@endisset>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="text" class="form-control" name="password" id="password" placeholder="Dejar en blanco para no actualizar" @if($method != 'update') required @endif>
        </div>

        <button type="submit" class="btn btn-primary">{{($method == 'update') ? 'Actualizar' : 'Crear'}} usuario</button>

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
