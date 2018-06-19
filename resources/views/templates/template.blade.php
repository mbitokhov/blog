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
        <link rel="stylesheet" type="text/css" href="{{ assets('css/app.css', true) }}" />
    </head>
    <body>
        @include('templates.navbar')


        <main id="app" class="section">
            <div class="container">
                @include('templates.notification')

                @yield('content')

                @stack('after-content')
            </div>
        </main>


        @include('templates.footer')
        <script src="{{ assets('js/app.js', true) }}"></script>
    </body>
</html>
