<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Site Metas -->
    <title>Basic Blog</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{URL::to('images/favicon.ico')}}" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="{{URL::to('images/apple-touch-icon.png')}}">

    <!-- Design fonts -->
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">

    <!-- FontAwesome Icons core CSS -->
    <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">

    <!-- Responsive styles for this template -->
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css">

    <!-- Colors for this template -->
    <link href="{{ asset('assets/css/colors.css') }}" rel="stylesheet" type="text/css">

    <!-- Version Garden CSS for this template -->
    <link href="{{ asset('assets/css/version/blog.css') }}" rel="stylesheet" type="text/css">

</head>

<body>
@if(\Illuminate\Support\Facades\Auth::check())
    @include('partials.admin-header')
@else
    @include('partials.guest-header')
@endif

<main class="container" style="border-radius: 0 0 20px 20px">
    @yield('content')
</main>
</div>
@include('partials.footer')
@stack('scripts')
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{asset('assets/js/tether.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
</body>
</html>
