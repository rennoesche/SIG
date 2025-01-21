<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Unlaravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css','resources/js/app.js'])
        <style>
            #map {
                height: calc(100vh - 64px);
            }
        @media only screen and (min-width: 768px) {
            .parent:hover .child {
                opacity: 1;
                height: auto;
                overflow: visible;
                transform: translateY(0);
            }

            .child {
                opacity: 0;
                height: 0;
                overflow: hidden;
                transform: translateY(-10%);
            }
        }

        @media only screen and (max-width: 768px) {
            .menu-hidden {
                display: none;
            }
        }
        
    </style>
    </head>
    <body class="font-sans antialiased">
        @include('layouts.nav')
        @yield('content')
    </body>
</html>
