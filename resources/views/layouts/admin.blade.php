<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>:: Dashboard ::</title>



    {{-- Favicon --}}
        {{-- <link rel="apple-touch-icon" sizes="57x57" href="{{Vite::asset('resources/front/images/favicon/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{Vite::asset('resources/front/images/favicon/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{Vite::asset('resources/front/images/favicon/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{Vite::asset('resources/front/images/favicon/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{Vite::asset('resources/front/images/favicon/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{Vite::asset('resources/front/images/favicon/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{Vite::asset('resources/front/images/favicon/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{Vite::asset('resources/front/images/favicon/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{Vite::asset('resources/front/images/favicon/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{Vite::asset('resources/front/images/favicon/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{Vite::asset('resources/front/images/favicon/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{Vite::asset('resources/front/images/favicon/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{Vite::asset('resources/front/images/favicon/favicon-16x16.png')}}"> --}}
    {{-- <link rel="manifest" href="{{Vite::asset('resources/front/images/favicon/manifest.json')}}"> --}}
    {{-- <meta name="msapplication-TileImage" content="{{Vite::asset('resources/front/images/favicon/ms-icon-144x144.png')}}"> --}}
    {{-- Favicon --}}

    {{-- <!-- Font Css -->
    <link href="./font/stylesheet.css" media="all" rel="stylesheet">
    <!-- Style Css -->
    <link href="css/style.css" media="all" rel="stylesheet"> --}}
    @vite(['resources/admin/scss/app.scss', 'resources/admin/js/app.js'])
</head>
<body>
    <div class="loaderwraper-main">
        <div class="loader-wrapper">
            <div class="loader-wrapper-box">
                <span class="circle"></span>
                <span class="circle"></span>
                <span class="circle"></span>
                <span class="circle"></span>
              </div>
        </div>
    </div>
    <div class="wrapar">
        @include('admin/includes/sidenav')
        <div class="mainbar">
            @include('admin/includes/header')
            <div class="content-body">
                @yield('content')
                {{-- <div class="content-wraper">
                    dashboard
                </div> --}}
            </div>
            @include('admin/includes/footer')
        </div>
    </div>
    @stack('scripts')
    <script>
        //loader remove on ready state
		document.onreadystatechange = function () {
			var state = document.readyState
            //console.log(state);
			if (state == 'interactive') {
				//console.log('interactive');
				//$('.loader').attr("style", "display:none");
			} else if (state == 'complete') {
                console.log('complete');
				$('.loaderwraper-main').attr("style", "display:none");

			}
		}
        var base_url = '{{url('/')}}';
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</body>
</html>
