<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://api.fontshare.com/v2/css?f[]=outfit@400,500,600,700&display=swap" rel="stylesheet">    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-u5aUqGF5.css') }}">
    <script type="module" src="{{ asset('build/assets/app-D8-IfpPU.js') }}"></script> --}}

    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @inertiaHead
    <script>
        window.logoUrl = "{{ asset('images/afropulse-logo.svg') }}";
    </script>

    <style>
        .p-datatable-column-title {
            font-weight: 550 !important;
            color: #292929 !important;
        }
    </style>
</head>

<body>
    @routes
    @inertia
    <script src="https://js.paystack.co/v1/inline.js"></script>
</body>

</html>
