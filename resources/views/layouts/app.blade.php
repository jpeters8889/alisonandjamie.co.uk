<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ mix('/assets/css/app.css') }}"/>

    <meta name="robots" content="noindex">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('page-view-builder::header')

    <link rel="preload" as="font" href="/assets/fonts/DirtyHeadline.ttf" type="font/ttf" crossorigin="anonymous">
    <link rel="preload" as="font" href="/assets/fonts/DirtyHeadline.woff" type="font/woff" crossorigin="anonymous">
    <link rel="preload" as="font" href="/assets/fonts/PunkRockShow-Regular.ttf" type="font/ttf" crossorigin="anonymous">
    <link rel="preload" as="font" href="/assets/fonts/PunkRockShow-Regular.woff" type="font/woff" crossorigin="anonymous">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PDVRZEFJKY"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-PDVRZEFJKY');
    </script>

</head>
<body class="flex">

<div class="w-full flex flex-col" id="app">
    <header class="w-full flex flex-col">
        <navigation></navigation>

        @yield('header')
    </header>

    <div class="mt-2 flex-1 flex flex-col space-y-3 mt-3 px-2 xl:px-0">
        @yield('content')
    </div>

    <footer class="bg-gray-900 w-full">
        <div class="max-w-site mx-auto p-2 text-center text-white">
            <p class="font-headline text-lg">Alison and Jamie</p>
            <p class="font-headline text-sm">11th September 2021</p>
        </div>
    </footer>
</div>

<script src="{{ mix('/assets/js/manifest.js') }}" async defer></script>
<script src="{{ mix('/assets/js/vendor.js') }}" async defer></script>
<script src="{{ mix('/assets/js/app.js') }}" async defer></script>

@yield('scripts')

</body>
</html>
