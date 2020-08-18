<div class="bg-primary p-md-5 p-2 rounded shadow">
    <form action="{{route('search')}}">
        @csrf
        <div class="row">
            <div class="col-md-10 mt-2">
                <input name="search" class="form-control form-control-block" type="text" placeholder="Qué estas buscando">
            </div>
            <div class="col-md-2 mt-2">
                <button class="btn btn-block btn-outline-light">Buscar</button>
            </div>
        </div>

    </form>
</div>
