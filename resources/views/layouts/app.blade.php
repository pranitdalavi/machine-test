<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Machine Test</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        #sidebar a.active {
            color: white;
        }
        #sidebar{
            width: 250px;
            height: 100%;
            background-color: #333;
            position: fixed;
            padding-top: 20px;
        }

        #content {
            margin-left: 250px;
            padding: 16px;
        }

        #sidebar a {
            padding: 8px;
            text-decoration: none;
            font-size: 18px;
            color: #818181;
            display: block;
        }

        #sidebar a:hover {
            color: #f1f1f1;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                
            </div>
        </nav>
        <div id="sidebar">
        <a href="/personal-details" class="{{ (Request::is('personal-details')) ? 'active' : '' }}"><i class="fas fa-file-alt text-primary"></i><span  style="margin-left:3%">Demo Fields</span></a>
        <a href="/public-ip-address"  class="{{ (Request::is('public-ip-address')) ? 'active' : '' }}"><i class="fas fa-network-wired text-secondary"></i><span  style="margin-left:3%">IP Address</span></a>
        <a href="/get-records"  class="{{ (Request::is('get-records')) ? 'active' : '' }}"><i class="fas fa-arrow-right text-secondary"></i><span  style="margin-left:3%">Traverse Records</span></a>
        <a href="/email"  class="{{ (Request::is('email')) ? 'active' : '' }}"><i class="fas fa-envelope text-danger"></i><span  style="margin-left:3%">E-mail</span></a>
        <!-- Add more sidebar links as needed -->
    </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>