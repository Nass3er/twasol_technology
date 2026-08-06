<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    data-theme="emerald">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Error404 Not Found</title>
    <link rel="icon" type="image/ico" href="{{ asset('favicon.ico') }}">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="/vendor/flag-icon-css/css/flag-icon.min.css" />
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- @vite(['resources/sass/app.scss']) --}}
    @endif

{{--     
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    @yield('css')
</head>

<body>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            // duration: 800, // animation duration
            once: true // animation only once when scrolling down
        });
    </script>
    @livewireScripts
    @yield('jsbefore')
    {{-- <div id="app"> --}}
    <main>

        @yield('content')
        
    </main>
    {{-- </div> --}}
    @yield('jsafter')
    
</body>

</html>
