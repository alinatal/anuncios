@extends('layouts.admin')

@section('title', 'Usuarios')
@section('action')
    <a class="btn btn-sm btn-primary ml-3" href="{{route('admin.user.create')}}">Añadir usuario</a>
    @if( app('request')->input('name') )
        <a class="btn btn-sm btn-secondary ml-3" href="{{route('admin.user.index')}}">Volver atrás</a>
    @endif
    <form action="" class="d-inline-flex input-group-sm">
        <input type="text" name="name" class="form-control d-inline-flex" placeholder="Buscar por nombre" value="{{app('request')->input('name')}}">
    </form>
@endsection

@section('content')
    @if($users->count())
        <div class="table-responsive">
            <table class="table table-striped bg-white table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Admin</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{($user->admin) ? 'Si' : 'No'}}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{route('admin.user.edit', $user->id)}}" class="btn btn-secondary btn-block">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>

                                </div>
                                <div class="col-md-6">
                                    <form action="{{route('admin.user.destroy', $user->id)}}" method="POST">
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

        {!! $users !!}
    @else
        <p class="text-muted">No se encontraron usuarios</p>
    @endif

@endsection
