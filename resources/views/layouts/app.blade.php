<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="has-background-light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Open Org Chart') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.8.0/css/bulma.min.css" integrity="sha256-D9M5yrVDqFlla7nlELDaYZIpXfFWDytQtiV+TaH6F1I=" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css?family=Public+Sans:300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>
<body>

@include('includes.header')

<main class="section">
    <div class="container">
        <h1 class="title is-2 has-text-centered">@yield('title')</h1>
        <div class="columns is-centered">
            <div class="column">
                @yield('content')
            </div>
        </div>
    </div>
</main>

<script defer src="{{ asset('js/app.js') }}"></script>

</body>
</html>
