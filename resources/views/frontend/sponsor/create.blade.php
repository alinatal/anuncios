@extends('layouts.app')
@section('title', 'Contratar publicidad')

@section('content')
    <form action="{{route('sponsor.store')}}" method="POST">
        @csrf
        @method('POST')

        <label class="d-block h4">Datos del anuncio</label>

        <label for="price">Precio de promoción en una categoría (tipo de contrato):</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_type" id="monthly" value="monthly" checked>
            <label class="form-check-label" for="monthly">
                Pago mensual (15€ / mes)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_type" id="biannual" value="biannual">
            <label class="form-check-label" for="biannual">
                Pago semestral (72€ / semestre)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_type" id="annual" value="annual">
            <label class="form-check-label" for="annual">
                Pago anual (120€ / año)
            </label>
        </div>

        <div class="form-group mt-4">
            <label for="description">Descripción (opcional)</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Introduzca una breve descripción de su empresa, esto es útil para un mejor posicionamiento en los buscadores"></textarea>
        </div>

        <div class="form-group mt-4">
            <label for="web">Página web (opcional)</label>
            <input type="url" class="form-control" name="web" id="web" placeholder="Introduza su web si quiere que la promocionemos junto a su anuncio">
        </div>

        <div class="form-group mt-4">
            <label for="category">Categoría donde quiere promocionarse:</label>
            <select class="form-control" id="category">
                @foreach($categories as $category)
                    <option value="categories.{{$category->slug}}">{{$category->parent->name}} -> {{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <p class="text-center">
            <small>
                IMPORTANTE: No olvide enviarnos por email a
                <a href="mailto:{{config('settings.site_email')}}">
                    {{config('settings.site_email')}}
                </a>
                el anuncio que quiere poner, el tamaño debe de ser de
                1200 x 450 pixeles, o si lo prefiere envíenos su logotipo
                con una descripción de lo que quiere poner y nosotros se
                lo diseñamos.
            </small>
        </p>


        <label class="d-block h4">Datos fiscales (para la facturación)</label>

        <div class="form-group mt-4">
            <label for="full_name">Nombre fiscal</label>
            <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Introduza su nombre fiscal" required>
        </div>
        <div class="form-group mt-4">
            <label for="address">Dirección</label>
            <input type="text" class="form-control" name="address" id="address" placeholder="Introduza su dirección" required>
        </div>
        <div class="form-group mt-4">
            <label for="address">Correo electrónico</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Introduza su email" required>
        </div>
        <div class="form-group mt-4">
            <label for="phone">Teléfono</label>
            <input type="tel" class="form-control" name="phone" id="phone" placeholder="Introduza su teléfono" required>
        </div>
        <div class="form-group mt-4">
            <label for="city">Código Postal y Localidad</label>
            <input type="text" class="form-control" name="city" id="city" placeholder="CP, Localidad" required>
        </div>
        <div class="form-group mt-4">
            <label for="cif">CIF</label>
            <input type="text" class="form-control" name="cif" id="cif" placeholder="Código de Identificación Fiscal" required>
        </div>
        <div class="form-group mt-4">
            <label for="bank_account">Cuenta Bancaria</label>
            <input type="text" class="form-control" name="bank_account" id="bank_account" placeholder="Número de cuenta para el pago de los recibos" required>
        </div>

        <div class="form-check mt-4">
            <input class="form-check-input" type="checkbox" value="" id="terms" onchange="activateButton(this)">
            <label class="form-check-label" for="terms">
                Acepto las condiciones del contrato de publicidad
            </label>
        </div>

        <button class="btn btn-primary btn-lg btn-block mt-4" type="submit" id="submit" disabled>Contratar</button>
        <p id="accepted_message" class="small text-center mt-3 text-danger">Debe aceptar las condiciones para proceder con el contrato</p>

        <p class="small text-center mt-3">
            Recuerde que puede darse de baja en cualquier momento sin ningún tipo de compromiso.
        </p>
        <p class="small text-center">
            También puede modificar su anuncio cuantas veces estime necesario, tan sólo debe enviarnos un email
            con el nuevo anuncio a
            <a href="mailto:{{config('settings.site_email')}}">
                {{config('settings.site_email')}}
            </a>
        </p>
    </form>
@endsection

@section('scripts')
    <script>
        let submit = document.getElementById('submit');
        let message = document.getElementById('accepted_message');
        let terms = document.getElementById('terms');
        submit.disabled = true;
        message.hidden = false;
        terms.checked = false;

        function activateButton(element) {
            let submit = document.getElementById('submit');
            let message = document.getElementById('accepted_message');
            if(element.checked){
                submit.disabled = false;
                message.hidden = true;
            }
            else{
                submit.disabled = true;
                message.hidden = false;
            }
        }
    </script>
@endsection
