<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Frebles') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Include SweetAlert CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

        <!-- Include SweetAlert JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <!-- Include Font Awesome -->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('landingpage/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/frebles1hd.png') }}">

        <!-- Bootstrap icon library  -->
        <link href="{{ ('node_modules/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">

        <!-- Link to CSS file -->
        <link rel="stylesheet" href="{{ asset('landingpage/assets/css/myorders.css') }}">
        <link rel="stylesheet" href="{{ asset('landingpage/assets/css/mywishlist.css') }}">
        <link rel="stylesheet" href="{{ asset('landingpage/assets/css/myreviews.css') }}">

    </head>
    <body class="font-sans antialiased" id="master">

        <!-- Session Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill h3"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Bootstrap core JavaScript -->
        <script src="{{ asset('landingpage/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('landingpage/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('landingpage/assets/js/isotope.min.js') }}"></script>
        <script src="{{ asset('landingpage/assets/js/owl-carousel.js') }}"></script>
        <script src="{{ asset('landingpage/assets/js/counter.js') }}"></script>
        <script src="{{ asset('landingpage/assets/js/custom.js') }}"></script>

    </body>
</html>
