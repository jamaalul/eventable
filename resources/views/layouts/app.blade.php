<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=DM-Sans:400,500,600&display=swap" rel="stylesheet" />

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');

        .plus-jakarta-sans {
            font-family: "Plus Jakarta Sans", sans-serif;
            font-optical-sizing: auto;
        }
    </style>

    @livewireStyles
</head>

<body>
    @yield('content')

    @livewireScripts
    @fluxScripts
    <livewire:toast />
</body>

</html>
