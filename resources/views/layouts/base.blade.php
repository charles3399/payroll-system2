<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Welcome to LaraPayroll! A comprehensive web app for payroll automation">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <script src="{{ asset('js/app.js') }}" defer></script>

        <link rel="shortcut icon" href="https://img.icons8.com/dusk/32/000000/payroll.png" type="image/x-icon">

        <!-- css -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @stack('scripts')
    </head>
    <body class="bg-blue-500 box-border m-0 p-0">
        <div id="app">
            @include('layouts.navigation')
            @yield('content')
            @include('layouts.footer')
        </div>
    </body>
</html>