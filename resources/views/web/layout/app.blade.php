<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no, email=no, date=no, address=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="Pragma" content="no-cache">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="_token" content="{{ csrf_token() }}" />
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>YANDU</title>

    <!-- Bootstrap -->
    {{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">--}}
    <link href="{{asset('web/css/docs.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/bootstrap.min.css')}}" rel="stylesheet">
    {{--<link rel="stylesheet" href="{{asset('assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">--}}
    <link rel="stylesheet" href="{{asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/argon.css?v=1.1.0')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')}}">
    @yield('web_css')

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <!--<script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>-->
{{--<script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>--}}
<!--[endif]-->
</head>
<body style="background-color: #ffffff">
@include('web.layout.header')

@yield('detail')
@include('web.layout.footer')
@yield('web')

{{--<script src="{{asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>--}}
<script src="{{asset('assets/vendor/js-cookie/js.cookie.js')}}"></script>

<script src="{{asset('web/js/jquery-3.2.1.slim.min.js')}}"></script>
<script src="{{asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('web/js/popper.min.js')}}"></script>
<script src="{{asset('web/js/bootstrap.min.js')}}"></script>
<script src="{{asset('web/js/main.js')}}"></script>
<script src="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>



<!-- Optional JS -->
<script src="{{asset('assets/vendor/onscreen/dist/on-screen.umd.min.js')}}"></script>
<!-- Argon JS -->
<script src="{{asset('assets/js/argon.js?v=1.1.0')}}"></script>
@yield('web_js')

</body>
</html>