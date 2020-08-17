@extends('layouts.admin')

@section('title', 'Ajustes Generales')

@section('content')
    @if($settings->count())
    <form action="{{route('admin.settings.update')}}" method="POST">
        @method('PUT')
        @csrf
        @foreach($settings as $setting)
            <div class="form-group @if($setting->type=='json') sortable @endif">
                <label for="{{$setting->key}}">{{$setting->label}}</label>
                @if($setting->type == 'textarea')
                    <textarea class="form-control" name="{{$setting->key}}" id="{{$setting->key}}" cols="30" rows="10">{{$setting->value}}</textarea>
                @elseif($setting->type == 'json')
                    @foreach(json_decode($setting->value) as $key => $value)

                        <div class="form-group ml-5">
                            <label for="{{$key}}">{{$key}}</label>
                            <div class="row">
                                <input class="form-control array col-sm-10" type="text" id="{{$key}}" name="{{$setting->key}}[{{$key}}]" value="{{$value}}">
                                <div class="input-group-append col-sm-2">
                                    <span class="btn btn-danger borrar form-control">Borrar</span>
                                </div>
                            </div>

                        </div>
                    @endforeach


                    <div class="form-group ml-5 mt-5 mb-5">
                        <div class="row">
                            <input type="text" class="form-control  col-sm-10" placeholder="Nombre del elemento">
                            <div class="input-group-append col-sm-2">
                                <span id="{{$setting->key}}" class="btn btn-primary add form-control">Añadir</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-center font-weight-light h6 mb-2 mt-2 d-none d-sm-block">Arrastre los elementos de su nombre para ordenar el menu</p>


                @else
                    <input class="form-control" type="{{$setting->type}}" id="{{$setting->key}}" name="{{$setting->key}}" value="{{$setting->value}}">
                @endif
            </div>
        @endforeach
        <div></div>
        <button class="btn btn-primary btn-lg btn-block mt-5 mb-5">Guardar ajustes</button>
    </form>
    @else
        No se encontró ningun ajuste
    @endif
@endsection

@section('scripts')
    @if($settings)
    <script src="https://cdn.tiny.cloud/1/0xmf4kd6fgzni5qvr3mc0ephfda1c2m8pc5dwgrirjxj4taf/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            language_url: '{{asset('vendor/tinymce/langs/')}}'
            language: 'es_ES',
        });
    </script>
    <style src="{{asset('js/jquery-ui/jquery-ui.min.css')}}"></style>
    <style src="{{asset('js/jquery-ui/jquery-ui.structure.min.css')}}"></style>
    <style src="{{asset('js/jquery-ui/jquery-ui.theme.min.css')}}"></style>
    <style>
        .ui-sortable-handle > label {
            cursor: move;
        }
    </style>

    <script src="{{asset('js/jquery-ui/jquery-ui.min.js')}}"></script>
    <script>
        var input = `<div class="form-group ml-5">
            <label for="">{{$key}}</label>
            <div class="row">
            <input class="form-control array col-10" type="text" id="{{$key}}" name="{{$setting->key}}[{{$key}}]" value="{{$value}}">
            <div class="input-group-append col-2">
            <span class="btn btn-danger borrar">Borrar</span>
            </div>
            </div>

            </div>`
        //$('.array')
        function borrar(){
            $('.borrar').click(function(){
                $(this).parent().parent().parent().remove();
            })
        }
        borrar();

        $('.add').click(function () {
            //console.log($(this).parent().parent().parent());
            if($(this).parent().prev().val().length){
                $(this).parent().parent().parent().before(
                    `<div class="form-group ml-5">
                        <label for="${$(this).parent().prev().val()}">${$(this).parent().prev().val()}</label>
                        <div class="row">
                            <input class="form-control array col-10" type="text" id="${$(this).parent().prev().val()}" name="${$(this).attr('id')}[${$(this).parent().prev().val()}]">
                            <div class="input-group-append col-2">
                                <span class="btn btn-danger borrar form-control">Borrar</span>
                            </div>
                        </div>
                    </div>`
                );
                borrar();
                $(this).parent().prev().val('');
            }
        })



        $('.sortable').sortable();

    </script>
    @endif
@endsection
