<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="严度是专业的空气治理、空气检测、除醛净化综合服务平台，通过“互联网+空气治理”掀起一场健康居家、现代装修新革命，覆盖整个居所装修后空气质量产业链条，产品包括空气治理、空气净化、空气权威检测、空气净化设备、空气治理药剂等">
    <meta name="keywords" content="空气治理,空气净化,空气检测,空气检测网站,除醛净化,除甲醛,空气净化设备,空气治理药剂," >
    <meta name="renderer" content="webkit">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>严度商户后台</title>
    <!-- Favicon -->
    <link rel="icon" href="{{asset('assets/img/logo.jpeg')}}" type="image/png">
    <!-- Fonts -->
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
    @yield('css')
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/argon.css?v=1.1.0')}}" type="text/css">
</head>

<body>
<!-- Sidenav -->
@include('admin.layout.sidebar')
<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Topnav -->
    @include('admin.layout.header')
    <!-- Header -->
    <!-- Header -->
    @yield('contend_head')
    <div class="container-fluid mt--6">
        @yield('contend')

        @include('admin.layout.footer')
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
@yield('js')


<!-- Optional JS -->
<script src="{{asset('assets/vendor/onscreen/dist/on-screen.umd.min.js')}}"></script>
<!-- Argon JS -->
<script src="{{asset('assets/js/argon.js?v=1.1.0')}}"></script>
<!-- Demo JS - remove this in your project -->
<script src="{{asset('assets/js/demo.min.js')}}"></script>
</body>

</html>