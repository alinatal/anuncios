<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Mantenimiento | Anuncios Lucena</title>
</head>
<body class="p-5" style="background-color: #F7FAFC;">
    <div class="row mb-5 mt-5">
        <div class="col-4"></div>
        <div class="col-4">
            <img src="{{asset('img/logo.png')}}" class="img-fluid" alt="Anuncios Lucena">
        </div>
        <div class="col-4"></div>
    </div>
    {{--<p class="text-muted text-center">Tu nuevo portal de anuncios gratis en Lucena y comarca, para particulares y profesionales</p>
    <p class="text-muted text-center">Disponible a partir del <strong>1 de Septiembre</strong>.</p>--}}
    {{$message}}
    <div class="row mb-5 mt-5">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="form-group">
                <form action="">
                    @csrf
                    <input type="text" name="access" placeholder="Acceso anticipado..." class="form-control text-center">
                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>
</html>
