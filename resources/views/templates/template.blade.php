<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @hasSection('title')
          <title> @yield('title') - {{ config('app.name') }}</title>
        @else
          <title> {{ config('app.name') }} </title>
        @endif
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ assets('css/bulma.css') }}"
            integrity="sha512-{{ App\Services\FileHasher::make(public_path('css/bulma.css')) }}"
            crossorigin="anonymous" />
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ assets('css/app.css') }}"
            integrity="sha512-{{ App\Services\FileHasher::make(public_path('css/app.css')) }}"
            crossorigin="anonymous"/>
    </head>
    <body>
        @include('templates.navbar')


        <main id="app" class="container section">
            @include('templates.notification')

            @yield('content')

            @stack('after-content')
        </main>


        @include('templates.footer')
        <script
            src="{{ assets('js/manifest.js') }}"
            integrity="sha512-{{ App\Services\FileHasher::make(public_path('js/manifest.js'), 'sha512') }}"
            crossorigin="anonymous"
        ></script>
        <script
            src="{{ assets('js/vendor.js') }}"
            integrity="sha512-{{ App\Services\FileHasher::make(public_path('js/vendor.js'), 'sha512') }}"
            crossorigin="anonymous"
        ></script>
        <script
            src="{{ assets('js/app.js') }}"
            integrity="sha512-{{ App\Services\FileHasher::make(public_path('js/app.js'), 'sha512') }}"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
