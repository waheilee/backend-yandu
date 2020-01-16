<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="" >
    <meta name="renderer" content="webkit">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>严度商户后台</title>
    <!-- Favicon -->
    <link rel="icon" href="{{asset('assets/img/logo.jpeg')}}" type="image/png">
    <!-- Fonts -->
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
    @yield('se_new_css')
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/argon.css?v=1.1.0')}}" type="text/css">
</head>

<body>
<!-- Sidenav -->
@include('se_new.layout.sidebar')
<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Topnav -->
    @include('se_new.layout.header')
    <!-- Header -->
    <!-- Header -->
    @yield('se_new_contend_head')
    <div class="container-fluid mt--6">
        @yield('se_new_contend')

        @include('se_new.layout.footer')
        <!-- Footer -->
    </div>


</div>
<!-- Argon Scripts -->
<!-- Core -->
@include('vendor.ueditor.assets')

<script src="{{asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
<script src="{{asset('assets/vendor/quill/dist/quill.min.js')}}"></script>
@yield('se_new_js')


<!-- Optional JS -->
<script src="{{asset('assets/vendor/onscreen/dist/on-screen.umd.min.js')}}"></script>
<!-- Argon JS -->
<script src="{{asset('assets/js/argon.js?v=1.1.0')}}"></script>
<!-- Demo JS - remove this in your project -->
<script src="{{asset('assets/js/demo.min.js')}}"></script>
</body>

</html>