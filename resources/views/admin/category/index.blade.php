@extends('layouts.admin')

@section('title')

    @if(app()->get('request')->input('id'))
        Subcategorías de {{$category->name}}
    @else
        Categorías Principales
    @endif

@endsection

@section('action')
    @if(app()->get('request')->input('id'))
        <a class="btn btn-sm btn-secondary ml-3" href="{{route('admin.category.index')}}">Volver</a>
    @else
        <a class="btn btn-sm btn-primary ml-3" href="{{route('admin.category.create')}}">Añadir categoría principal</a>
    @endif
@endsection

@section('content')



    @if($categories->count())
        @isset($category)
            <x-breadcrumb
                :home="route('admin.category.index')"
                :breadcrumbs="$category->getAncestors()"
                :postname="$category->name"
                :slug="false"
                :route="'admin.category.index'"
            ></x-breadcrumb>
        @endif
        <div class="table-responsive">
            <table class="table table-striped bg-white table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <th scope="row">{{$category->id}}</th>
                        <td><img src="{{asset($category->image)}}" class="img-thumbnail" width="100px" alt=""></td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->slug}}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-2 mt-2">
                                    <a href="{{route('category.show',$category->slug)}}" target="_blank" class="btn btn-primary btn-block">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </div>

                                    <div class="col-md-2 mt-2">
                                        @if($category->ads->count() == 0)
                                        <a href="{{route('admin.category.create', ['parent' => $category->id])}}" class="btn btn-success btn-block">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </a>
                                        @endif
                                    </div>

                                <div class="col-md-2 mt-2">
                                    @if(!$category->isLeaf())
                                    <a href="{{route('admin.category.index', ['id' => $category->id])}}" class="btn btn-info btn-block">
                                        <i class="fas fa-sitemap"></i>
                                    </a>
                                    @endif
                                </div>
                                <div class="col-md-2 mt-2">
                                    @if($category->getPrevSibling())
                                        <a href="{{route('admin.category.shiftUp', $category)}}" class="btn btn-warning btn-block">
                                            <i class="fas fa-arrow-up"></i>
                                        </a>
                                    @endif
                                    @if($category->getNextSibling())
                                        <a href="{{route('admin.category.shiftDown', $category)}}" class="btn btn-warning btn-block">
                                            <i class="fas fa-arrow-down"></i>
                                        </a>
                                    @endif
                                </div>

                                <div class="col-md-2 mt-2">
                                    <a href="{{route('admin.category.edit', $category->slug)}}" class="btn btn-secondary btn-block">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>

                                </div>
                                <div class="col-md-2 mt-2">
                                    <form action="{{route('admin.category.destroy', $category->slug)}}" method="POST">
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

        {!! $categories !!}
    @else
        <p class="text-muted">No se encontraron categorías</p>
    @endif

@endsection
