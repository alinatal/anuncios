@extends('layouts.app')

@section('title')
    Editando anuncio
    <small class="font-italic">
        {{(old('name') ? old('name') : $ad->name)}}
    </small>
@endsection

@section('content')
    <form method="POST" enctype="multipart/form-data" id="ad_update">
        @method('PUT')
        @csrf
        <div class="card mt-3">
            <div class="card-body">
                <div class="card-title"><h5>Información del producto / servicio</h5></div>
                <hr>
                <div class="form-group">
                    <label for="name">Nombre<small class="text-danger">*</small>: </label>
                    <input type="text" id="name" name="name" placeholder="Qué es lo que vendes" class="form-control @error('name') is-invalid @enderror" autocomplete="off" required value="@if(old('name')){{old('name')}}@else{{$ad->name}}@endif">
                    @error('name')
                    <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Descripción<small class="text-danger">*</small>: </label>
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
                    <fieldset>
                        <legend>Tipo de vendedor<small class="text-danger">*</small></legend>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="seller_type" id="profesional" value="profesional" class="custom-control-input" @if((old('seller_type'))){{(old('seller_type') == 'profesional') ? 'checked' : ''}} @else {{($ad->seller_type == 'profesional') ? 'checked' : ''}} @endif>
                            <label for="profesional" class="custom-control-label">Profesional</label>

                        </div>
                        <div class="custom-control custom-radio">

                            <input type="radio" name="seller_type" id="particular" value="particular" class="custom-control-input" @if((old('seller_type'))){{(old('seller_type') == 'particular') ? 'checked' : ''}} @else {{($ad->seller_type == 'particular') ? 'checked' : ''}}@endif>
                            <label for="particular" class="custom-control-label">Particular</label>

                        </div>
                    </fieldset>


                    @error('seller_type')
                    <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="location">Ubicación: </label>
                    <input type="text" id="location" name="location" placeholder="Donde se encuentra el bien o servicio que ofreces" class="form-control @error('location') is-invalid @enderror" value="@if(old('location')){{old('location')}} @elseif($ad->location) {{$ad->location}} @endif">
                    @error('location')
                    <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div id="images_data" class="row sortable">

                        @if(old('images'))
                            @foreach(old('images') as $image)
                                <div class="col-md-2 mt-3">
                                    <img src="{{$image}}" data-mfp-src="{{$image}}" class="img-thumbnail">
                                    <input type="hidden" name="images[]" value="{{$image}}">
                                    <button type="button" class="btn btn-block btn-outline-danger mt-1 parent_remove">Eliminar</button>
                                    <!--<button type="button" class="btn btn-block btn-outline-info handle mt-1">Mover</button>-->
                                </div>
                            @endforeach
                        @else

                            @foreach(json_decode($ad->images) as $image)
                                @if($image != '/img/no-image.png')
                                <div class="col-md-2 mt-3">
                                    @php($file_ext = pathinfo(app()->storagePath().'/app/'.$image, PATHINFO_EXTENSION))
                                    @php($file = file_get_contents(app()->storagePath().'/app/'.$image, true))
                                    <img src="data:image/{{$file_ext}};base64,{{base64_encode($file)}}" data-mfp-src="data:image/{{$file_ext}};base64,{{base64_encode($file)}}" class="img-thumbnail">
                                    <input type="hidden" name="images[]" value="data:image/{{$file_ext}};base64,{{base64_encode($file)}}">
                                    <button type="button" class="btn btn-block btn-outline-danger mt-1 parent_remove">Eliminar</button>
                                    <!--<button type="button" class="btn btn-block btn-outline-info handle mt-1">Mover</button>-->
                                </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="btn btn-block btn-primary mt-2">
                            <input type="file" accept="image/*" id="images" {{--name="images[]"--}} style="display: none;" multiple>
                            <i class="fas fa-plus"></i>
                            <span id="file_text">Añadir @if(old('images') || $ad->images) más @endif Imagenes</span>
                            <!--<label class="custom-file-label" for="customFile">Imagenes del producto / servicio</label>-->
                        </label>
                        <div id="images_error" class="alert alert-danger mt-2 mb-2" style="display: none;">No pueden añadir más imagenes, el numero máximo es 10</div>
                    </div>

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
                    <label for="fullName">Nombre<small class="text-danger">*</small>:</label>
                    <input type="text" id="fullName" name="fullName" class="form-control @error('fullName') is-invalid @enderror" placeholder="Cómo quieres que te llamen: nombre, seudónimo o empresa" required value="@if(old('fullName')){{old('fullName')}}@else{{$ad->user->name}}@endif">
                    @error('fullName')
                    <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email<small class="text-danger">*</small>:</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Tu correo electrónico" required value="@if(old('email')){{old('email')}}@else{{$ad->user->email}}@endif">
                    @error('email')
                    <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono:</label>
                    <input type="phone" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Tu numero de telefono" value="@if(old('phone')){{old('phone')}}@elseif($ad->user->phone){{$ad->user->phone}}@endif">
                    @error('phone')
                    <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                    @enderror
                </div>
                <p class="small text-danger text-center"><span class="text-uppercase">Aviso: </span>La modificación de los datos de contacto de este anuncio modificará los datos de contacto de cualquier anuncio asociado a su cuenta de correo electrónico.</p>
            </div>
        </div>

        <button class="btn btn-success btn-block btn-lg mt-5" onclick="tinyMCE.triggerSave();">Modificar anuncio</button>
        <p class="text-center mt-3 small">Todos los campos marcados con el símbolo <span class="text-danger">*</span> son campos obligatorios.</p>
    </form>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('js/magnific-popup/magnific-popup.css')}}">
@endsection

@section('scripts')
    <script>
        tinymce.init({
            selector: 'textarea',
            language: 'es_ES',
            language_url: '{{asset('vendor/tinymce/langs/es_ES.js')}}',
        });
    </script>

    <script src="{{asset('js/magnific-popup/jquery.magnific-popup.min.js')}}"></script>


    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>


    <script>
        document.getElementById("images").addEventListener("change", function (event) {
            compress(event);
        });
    </script>
    <script>
        function compress(e) {

            var array = [];
            const fileUpload = document.getElementById('images')
            const fileError = document.getElementById('images_error');
            const images = document.getElementById('images_data');
            const fileText = document.getElementById('file_text');
            fileText.innerHTML = 'Añadir más imagenes';


            for(var i = 0; (i < e.target.files.length) && (images.childElementCount+i < 10) ; i++){
                const fileName = e.target.files[i].name;
                const reader = new FileReader();
                reader.readAsDataURL(e.target.files[i]);
                reader.onload = event => {
                    const img = new Image();
                    img.src = event.target.result;
                    img.onload = () => {
                        const elem = document.createElement('canvas');
                        const width = 800;
                        const scaleFactor = width / img.width;
                        const height = img.height * scaleFactor;
                        elem.width = width;
                        elem.height = height;
                        const ctx = elem.getContext('2d');
                        // img.width and img.height will contain the original dimensions
                        ctx.drawImage(img, 0, 0, width, height);
                        const data = ctx.canvas.toDataURL('image/jpeg', 0.5);
                        let div = document.createElement('div');
                        div.className = 'col-md-2 mt-3';
                        images.insertBefore(div, null);
                        let newImg = new Image();
                        newImg.src = data;
                        newImg.setAttribute('data-mfp-src', data)
                        newImg.className = 'img-thumbnail img-responsive'
                        div.insertBefore(newImg, null);

                        $('.img-thumbnail').magnificPopup({
                            type: 'image',
                            gallery: {
                                enabled: true,
                                tCounter: '' // markup of counter
                            }
                        })

                        $('.handle').on('mouseleave touchend', function () {
                            $('.img-thumbnail').magnificPopup({
                                type: 'image',
                                gallery: {
                                    enabled: true,
                                    tCounter: '' // markup of counter
                                }
                            })
                        })

                        let input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'images[]';
                        input.value = data;
                        div.insertBefore(input, null);



                        let button = document.createElement('button');
                        button.type = 'button';
                        button.className = 'btn btn-block btn-outline-danger mt-1'
                        var text = document.createTextNode("Eliminar");
                        button.appendChild(text);
                        button.onclick = function () {
                            button.parentElement.remove();
                            if(images.childElementCount < 10){
                                fileUpload.disabled = false;
                                fileError.style.display = 'none';
                            }
                            if(images.childElementCount == 0){
                                var file_text = document.getElementById('file_text');
                                file_text.innerHTML = 'Añadir imagenes (máximo 10)';
                            }

                        }
                        div.insertBefore(button, null);

                        /*let move = document.createElement('button');
                        move.type = 'button';
                        move.className = 'btn btn-block btn-outline-info handle mt-1'
                        var text = document.createTextNode("Mover");
                        move.appendChild(text);
                        div.insertBefore(move, null);*/

                        if(images.childElementCount>=10){
                            fileUpload.disabled = true;
                            fileError.style.display = 'block';
                        }

                    };


                    reader.onerror = error => console.log(error);

                };


            }
            $('.sortable').sortable({
                handle: '.handle',
                animation: 150,
                ghostClass: 'blue-background-class'
            });
            //$('.sortable').sortable('destroy');




        }
    </script>



    <script>
        $('.sortable').sortable({
            handle: '.handle',
            animation: 150,
            ghostClass: 'blue-background-class'
        });

        $('.parent_remove').on('click', function(){
            $(this).parent().remove();
            const fileUpload = document.getElementById('images')
            const fileError = document.getElementById('images_error');
            const images = document.getElementById('images_data');
            if(images.childElementCount < 10){
                fileUpload.disabled = false;
                fileError.style.display = 'none';
            }
            if(images.childElementCount == 0){
                var file_text = document.getElementById('file_text');
                file_text.innerHTML = 'Añadir imagenes (máximo 10)';
            }
            $('.img-thumbnail').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true,
                    tCounter: '' // markup of counter
                }
            })
        });
        $('.handle').on('mouseleave touchend', function () {
            $('.img-thumbnail').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true,
                    tCounter: '' // markup of counter
                }
            })
        })
        $(document).ready(function() {
            $('.img-thumbnail').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true,
                    tCounter: '' // markup of counter
                }
            })
        })
    </script>

    <script src="{{asset('js/jquery.form.js')}}"></script>


    <script>
        $('#ad_update')
            .ajaxForm({
                url : '{{route('ads.update', $ad)}}', // or whatever
                type : 'POST',
                xhr: function() {
                    $('#app').hide();
                    $('#loading').show();
                    //upload Progress
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                        xhr.upload.addEventListener('progress', function (event) {
                            var percent = 0;
                            var position = event.loaded || event.position;
                            var total = event.total;
                            if (event.lengthComputable) {
                                percent = Math.ceil(position / total * 100);
                            }
                            //update progressbar
                            $("#upload-progress .progress-bar").css("width", +percent + "%");
                        }, true);
                    }
                    return xhr;
                },
                success : function (response) {
                    window.location.replace(response);
                },
                error: function (response) {
                    $('#app').show();
                    $('#loading').hide();
                    let errors =JSON.parse(response.responseText).errors
                    $('.error_message').remove();


                    jQuery.each(errors, function(key, value) {
                        let div = document.createElement('div');
                        div.className = "alert alert-danger mt-2 mb-2 error_message";
                        div.innerText = value;
                        div.id = key+'error';

                        $("#" + key).parent().append(div);
                    });

                },
            })
        ;
    </script>
@endsection
