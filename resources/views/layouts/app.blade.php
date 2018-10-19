<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '') }}</title>
    
    <!-- favicon -->
    <link rel="shortcut icon" href="/images/favicon.ico">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css"
    integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg"
    crossorigin="anonymous">

    @stack('styles')

</head>
<body>
    @include('partials.navigation')

    @yield('jumbotron')

    <div id="app">
        <main class="py-1">
            <div class="container">
                @include('flash::message')
            </div>
          @yield('content')
        </main>
    </div>

     @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    @stack('scripts')


    <script>
      $('div.alert.alertFlash').not('.alert-important').delay(4000).slideUp(400);
    </script>
</body>
</html>
