@extends('layouts.app')

@section('content')


        <h1>Editando anuncio <small class="font-italic">@if(old('name')){{old('name')}}@else{{$ad->name}}@endif</small></h1>

        <form action="{{route('ads.update', ['ad' => $ad->id])}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card mt-3">
                <div class="card-body">
                    <div class="card-title"><h5>Información del producto / servicio</h5></div>
                    <hr>
                    <div class="form-group">
                        <label for="name">Nombre: </label>
                        <input type="text" id="name" name="name" placeholder="Qué es lo que vendes" class="form-control @error('name') is-invalid @enderror" autocomplete="off" required value="@if(old('name')){{old('name')}}@else{{$ad->name}}@endif">
                        @error('name')
                        <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción: </label>
                        <textarea name="description" id="description" cols="30" rows="10" placeholder="Introduce una descripción del bien o servicio que ofreces" class="form-control @error('description') is-invalid @enderror" autocomplete="off" required>@if(old('description')){{old('description')}}@else{{$ad->description}}@endif</textarea>
                        @error('description')
                        <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Precio: </label>
                        <div class="input-group">
                            <input type="number" step="0.01" name="price" id="price" placeholder="Cantidad en euros que pides" class="form-control @error('price') is-invalid @enderror" autocomplete="off" required aria-describedby="euro" value="@if(old('pirce')){{old('price')}}@else{{$ad->price}}@endif">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">€</span>
                            </div>
                        </div>

                        @error('price')
                        <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="location">Ubicación: </label>
                        <input type="text" id="location" name="location" placeholder="Donde se encuentra el bien o servicio que ofreces" class="form-control @error('location') is-invalid @enderror" value="@if(old('location')){{old('location')}} @else {{$ad->location}} @endif">
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
                        <input type="text" id="fullName" name="fullName" class="form-control @error('fullName') is-invalid @enderror" placeholder="Tu nombre y apellidos" required value="@if(old('fullName')){{old('fullName')}}@else{{$ad->user->name}}@endif">
                        @error('fullName')
                        <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Tu correo electrónico" required value="@if(old('email')){{old('email')}}@else{{$ad->user->email}}@endif">
                        @error('email')
                        <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono:</label>
                        <input type="phone" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Solo si quieres recibir llamadas o whatsapps" value="@if(old('phone')){{old('phone')}}@else{{$ad->user->phone}}@endif">
                        @error('phone')
                        <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <button class="btn btn-success btn-block btn-lg mt-5">Modificar anuncio</button>

        </form>




@endsection

@section('scripts')
    <script>
        tinymce.init({
            selector: '#description'
        });
    </script>
@endsection
