<section id="footer" class="bg-dark mt-5">
    <div class="container pt-5">
        <div class="row text-center text-xs-center text-sm-left text-md-left text-white">
            <div class="col-xs-12 col-sm-10 col-md-10">
                <h5 class="font-weight-bold mb-2">{{$rightTitle}}</h5>
                <p>{{$rightText}}</p>
            </div>
            <div class="col-xs-12 col-sm-2 col-md-2">
                <h5 class="font-weight-bold mb-2">Información</h5>
                <ul class="list-unstyled quick-links">
                    <x-list-item :list="config('settings.site_secondary_menu')" :bullet="true"></x-list-item>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
                <ul class="list-unstyled text-center">
                    <li class="list-inline-item mr-4 ml-4"><a href="{{$facebook}}" class="text-decoration-none text-white"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a></li>
                    <li class="list-inline-item mr-4 ml-4"><a href="{{$instagram}}" class="text-decoration-none text-white"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a></li>
                    <li class="list-inline-item mr-4 ml-4"><a href="{{$twitter}}" class="text-decoration-none text-white"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a></li>
                </ul>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                <p><u><a href="{{$siteLink}}" class="text-white text-decoration-none">© {{$siteName}}</a></u> Página registrada por Alinatal, S.L.</p>
                <p class="h6">Desarrollado por <a class="text-primary text-decoration-none" href="{{$authorLink}}" target="_blank">{{$author}}</a></p>
            </div>
            <hr>
        </div>
    </div>
</section>
