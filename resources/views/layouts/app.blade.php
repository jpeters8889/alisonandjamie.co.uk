<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ mix('/assets/css/app.css') }}"/>

    <meta name="robots" content="noindex">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('page-view-builder::header')
</head>
<body class="">

<div class="" id="app">
    @yield('content')
</div>

<script src="{{ mix('/assets/js/manifest.js') }}" async defer></script>
<script src="{{ mix('/assets/js/vendor.js') }}" async defer></script>
<script src="{{ mix('/assets/js/app.js') }}" async defer></script>

</body>
</html>
