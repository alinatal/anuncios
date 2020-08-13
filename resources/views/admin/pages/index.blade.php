@extends('layouts.admin')

@section('title', 'Páginas')
@section('action')
    <a class="btn btn-sm btn-primary ml-3" href="{{route('admin.pages.create')}}">Añadir página</a>
@endsection

@section('content')
    @if($pages->count())
        <div class="table-responsive">
        <table class="table table-striped bg-white table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Slug</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
        @foreach($pages as $page)
            <tr>
                <th scope="row">{{$page->id}}</th>
                <td>{{$page->name}}</td>
                <td>{!!  \Illuminate\Support\Str::limit($page->description, 50) !!}</td>
                <td>{{$page->slug}}</td>
                <td>
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{route('pages.show',$page->slug)}}" target="_blank" class="btn btn-primary btn-block">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{route('admin.pages.edit', $page->slug)}}" class="btn btn-secondary btn-block">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>

                        </div>
                        <div class="col-md-4">
                            <form action="{{route('admin.pages.destroy', $page->slug)}}" method="POST">
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

        {!! $pages !!}
    @else
        <p class="text-muted">No se encontraron páginas</p>
    @endif

@endsection
