<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('meta-tags')

    <link rel="apple-touch-icon" sizes="180x180" href="{{secure_asset('/img/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{secure_asset('/img/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{secure_asset('/img/favicon-16x16.png')}}">
    <link rel="manifest" href="{{secure_asset('/img/site.webmanifest')}}">
    <link rel="mask-icon" href="{{secure_asset('/img/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') @if(!request()->routeIs('main')) | @endif{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('styles')
</head>
<body>
    <div id="loading" style="display: none">
        <div class="text-center" style="height: 100%; width: 100%; z-index: 9999999; background-color: #0D4E60; position: absolute; display: flex; justify-content: center; align-items: center">
            <div class="fa-3x" style="">
                <i class="fas fa-spinner fa-spin text-white"></i>
                <p class="text-white h4">Subiendo el anuncio. Por favor, espere...</p>
            </div>
        </div>
    </div>
    <div id="app">
        @include('cookieConsent::index')


        <x-navbar
            :email="config('settings.site_email')"
            :phone="config('settings.site_phone')"
            :logo="config('settings.site_logo')"
            :facebook="config('settings.site_facebook')"
            :twitter="config('settings.site_twitter')"
            :instagram="config('settings.site_instagram')"
        ></x-navbar>


        <main class="py-4">
            <div class="container">
                @isset($message)
                    <div class="alert alert-info" role="alert">
                        {!! $message !!}
                    </div>
                @endisset
                @if(session('message'))
                    <div class="alert alert-info" role="alert">
                        {!! session('message') !!}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {!! session('error') !!}
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {!! session('success') !!}
                    </div>
                @endif
                    <h1>@yield('title') <small class="font-italic">@yield('subtitle')</small></h1>
                @yield('content')
            </div>
        </main>


        <x-footer
            :rightTitle="config('settings.site_footer_head')"
            :rightText="config('settings.site_footer_text')"
            :facebook="config('settings.site_facebook')"
            :twitter="config('settings.site_twitter')"
            :instagram="config('settings.site_instagram')"
            :siteName="config('settings.site_name')"
        ></x-footer>

    </div>
    <script src="https://kit.fontawesome.com/81b3fa9a46.js" crossorigin="anonymous" SameSite="None"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script crossorigin="anonymous"  src="https://cdn.tiny.cloud/1/0xmf4kd6fgzni5qvr3mc0ephfda1c2m8pc5dwgrirjxj4taf/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    @yield('scripts')

    @if(!(auth()->check() && auth()->user()))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{config('settings.site_google_analytics')}}"></script>

        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '{{config('settings.site_google_analytics')}}');
        </script>
    @endif
</body>
</html>
