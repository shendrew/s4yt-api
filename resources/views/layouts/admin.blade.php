<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <script src="https://kit.fontawesome.com/dda0a07667.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container-fluid">
    <div class="d-flex">
        <!-- sidebar -->
    @include('admin.includes.sidebar')
    <!-- content -->
        <div class="flex-grow-1">
            <!-- navbar -->
            @include('admin.includes.navbar')
            @yield('content')
        </div>
    </div>
</div>


<script src="{{ Illuminate\Support\Facades\URL::asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
    @yield ('footer_scripts')
</script>

<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
