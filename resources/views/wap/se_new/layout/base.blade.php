<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>xiniu</title>
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta content="telephone=no" name="format-detection"/>
    {{--<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">--}}
    <meta name="_token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{asset('web/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/argon.css?v=1.1.0')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('wap/se_new/css/ydui.css?rev=@@hash')}}"/>
    <link rel="stylesheet" href="{{asset('wap/se_new/css/demo.css')}}"/>
    <style>
        *{
            touch-action: none;
        }
        .rounded {
             border-radius: .16rem !important;
        }
    </style>
    @yield('wap_css')
    <script src="{{asset('wap/se_new/js/ydui.flexible.js')}}"></script>
</head>
<body>
<section class="g-flexview">
@yield('content')


</section>
<script src="{{asset('wap/se_new/js/ydui.citys.js')}}"></script>
{{--<script src="https://www.jq22.com/jquery/jquery-2.1.1.js" language="JavaScript" ></script>--}}
{{--<script src="{{asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>--}}
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>

<script src="{{asset('wap/se_new/js/ydui.js')}}"></script>

{{--<script src="{{asset('wap/js/jquery-1.11.2.min.js')}}"></script>--}}
<script src="{{asset('web/js/popper.min.js')}}"></script>
<script src="{{asset('web/js/bootstrap.min.js')}}"></script>


@yield('wap_js')

{{--<script>(!YDUI.device.isMobile && navigator.userAgent.indexOf('Firefox') >= 0) && YDUI.dialog.alert('PC端请使用谷歌内核浏览器查看！');</script>--}}
</body>
</html>
