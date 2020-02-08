<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="has-background-light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.8.0/css/bulma.min.css" integrity="sha256-D9M5yrVDqFlla7nlELDaYZIpXfFWDytQtiV+TaH6F1I=" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css?family=Gelasio:400,500,600,700|Public+Sans:300,400,500,600,700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Public Sans', sans-serif;
        }

        h1, h2, p {
            font-family: 'Gelasio', serif !important;
        }

        .org-chart-group {
            display: grid;
            align-items: start;
            grid-gap: 0 1.5rem;
            padding: 1.5rem 0.5rem 4rem;
            overflow: hidden;
            grid-template-columns: repeat(2, 1fr);
        }

        .org-chart-group .box {
            margin: 0 0 1.5rem !important;
        }

        .org-chart-group-department {
            grid-template-columns: 1fr;
            max-width: 100vw;
            overflow: auto;
        }

        .department-leader {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 125%;
            margin-bottom: 3rem;
        }

        .org-chart-employee {
            position: relative;
            display: inline-flex !important;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .org-chart-employee.leader {
            z-index: 10;
            justify-self: center;
            margin-bottom: 0 !important;
        }

        .org-chart-employee-pointer {
            position: absolute;
            display: inline-flex;
            width: 0.813rem;
            background-color: #3273dc;
            height: 0.125rem;
            pointer-events: none;
        }

        .org-chart-employee-pointer__top {
            top: -150%;
            height: 200%;
            width: 0.125rem;
            z-index: -1;
        }

        .org-chart-employee:nth-child(odd):not(.leader) {
            justify-self: end;
        }

        .org-chart-employee:nth-child(even):not(.leader) {
            justify-self: start;
        }

        .org-chart-employee:nth-child(odd) .org-chart-employee-pointer,
        .org-chart-employee:nth-child(odd) .org-chart-employee-pointer__top {
            right: -0.813rem;
        }

        .org-chart-employee:nth-child(even) .org-chart-employee-pointer,
        .org-chart-employee:nth-child(even) .org-chart-employee-pointer__top {
            left: -0.813rem;
        }
    </style>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>
<body>

@include('layouts.header')

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

</body>
</html>
