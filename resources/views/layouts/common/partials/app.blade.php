<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Currency Converter</title>
        {{-- Bootstrap --}}
        <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css"/>
        {{-- Fonts --}}
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        @include('layouts.common.partials.navbar')
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <!--begin::Content wrapper-->
                @yield('content')
            </div>
        </div>
        <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.js') }}"></script>
        @yield('scripts')
        @stack('scripts')
    </body>
</html>