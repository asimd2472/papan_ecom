<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales Baaz</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{Vite::asset('resources/front/images/favicon/favicon.ico')}}">
    
    {{-- Favicon --}}
    @vite(['resources/front/scss/style.scss', 'resources/front/js/app.js'])
</head>

<body>

    @include('includes.header')
        @yield('content')
    @include('includes.footer')
    @stack('scripts')
    <script>
        var base_url = '{{url('/')}}';
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
</body>

</html>
