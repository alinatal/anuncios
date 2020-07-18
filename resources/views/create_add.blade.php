@extends('layouts.app')

@section('content')


    @isset($categories)
        <x-category-list :categories="$categories" :accordion="true"></x-category-list>
    @else

        <h1>Nuevo anuncio de <small class="font-italic">{{$category->name}}</small></h1>

        <form action="{{route('ads.store')}}" method="POST" enctype="multipart/form-data">
            @method('post')
            @csrf
            <input type="hidden" name="category" value="{{$category->id}}{{old('category')}}">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="card-title"><h5>Información del producto / servicio</h5></div>
                    <hr>
                    <div class="form-group">
                        <label for="name">Nombre: </label>
                        <input type="text" id="name" name="name" placeholder="Qué es lo que vendes" class="form-control @error('name') is-invalid @enderror" autocomplete="off" required value="{{old('name')}}">
                        @error('name')
                        <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción: </label>
                        <textarea name="description" id="description" cols="30" rows="10" placeholder="Introduce una descripción del bien o servicio que ofreces" class="form-control @error('description') is-invalid @enderror" autocomplete="off" required>{{old('description')}}</textarea>
                        @error('description')
                        <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="location">Ubicación: </label>
                        <input type="text" id="location" name="location" class="form-control @error('location') is-invalid @enderror" value="{{old('location')}}">
                        @error('location')
                        <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="images">Imagenes: </label>
                        <input type="file" id="images" name="images[]" class="form-control-file" multiple>
                        @error('images')
                        <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                        @enderror
                        @error('images.*')
                        <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="card-title"><h5>Información de contacto</h5></div>
                    <hr>
                    <div class="form-group">
                        <label for="fullName">Nombre completo:</label>
                        <input type="text" id="fullName" name="fullName" class="form-control @error('fullName') is-invalid @enderror" placeholder="Tu nombre y apellidos" required value="{{old('fullName')}}">
                        @error('fullName')
                        <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Tu correo electrónico" required value="{{old('email')}}">
                        @error('email')
                        <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono:</label>
                        <input type="phone" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Solo si quieres recibir llamadas o whatsapps" value="{{old('phone')}}">
                        @error('phone')
                        <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <button class="btn btn-success btn-block btn-lg mt-5">Crear anuncio</button>

        </form>

    @endif



@endsection
