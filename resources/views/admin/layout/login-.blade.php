<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="严度是专业的空气治理、空气检测、除醛净化综合服务平台，通过“互联网+空气治理”掀起一场健康居家、现代装修新革命，覆盖整个居所装修后空气质量产业链条，产品包括空气治理、空气净化、空气权威检测、空气净化设备、空气治理药剂等">
    <meta name="keywords" content="空气治理,空气净化,空气检测,空气检测网站,除醛净化,除甲醛,空气净化设备,空气治理药剂," >
    <meta name="author" content="Creative Tim">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>严度商户后台 | 登录</title>
    <!-- Favicon -->
    <link rel="icon" href="{{asset('assets/img/logo.jpeg')}}" type="image/png">
    <!-- Fonts -->
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/build/toastr.css') }}">

    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/argon.css?v=1.1.0')}}" type="text/css">
    <style>
        .bg{
            background-image:url({{asset('assets/img/theme/img-1-1000x600.jpg')}}) no-repeat center;
            background-size:contain;
        }
    </style>
</head>
<body class="bg-white">
<!-- Navbar -->
{{--<div class="container-fluid">--}}
    {{--<nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">--}}
        {{--<div class="container">--}}
            {{--<a class="navbar-brand mr-0 mr-md-2" href="../../index.html" aria-label="Bootstrap">--}}
                {{--<img src="{{asset('assets/img/brand/logo.png')}}" style="height: 40px;">--}}

            {{--</a>--}}
        {{--</div>--}}
    {{--</nav>--}}
{{--</div>--}}
<nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="https://www.yd-hb.com/">
            <img src="{{asset('assets/img/logo2.png')}}" style="height: 40px;">
        </a>
        <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
            <div class="navbar-collapse-header">
                <div class="row">
                    {{--<div class="col-6 collapse-brand">--}}
                        {{--<a href="../../pages/dashboards/dashboard.html">--}}
                            {{--<img src="../../assets/img/brand/blue.png">--}}
                        {{--</a>--}}
                    {{--</div>--}}
                    {{--<div class="col-6 collapse-close">--}}
                        {{--<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">--}}
                            {{--<span></span>--}}
                            {{--<span></span>--}}
                        {{--</button>--}}
                    {{--</div>--}}
                </div>
            </div>
            <hr class="d-lg-none">
        </div>
    </div>
</nav>
<!-- Main content -->
<div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-yandu py-1 py-lg-1 pt-lg-1">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">

                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">

        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid" style="min-height: 500px; background-image: url(../../assets/img/banner3.jpeg); background-size: cover; background-position: center top;">
        <div class="container" >


            <div class="row pb-5">
                <div class="col">
                    <div class="col-md-8 float-md-left mt-6 mb-6">
                        <div class="probootstrap-text">
                            <h1 class="display-1 text-white mb-4">WELCOME</h1>
                            <div class="probootstrap-subheading mb-5">
                                <h1 class="display-1 text-white mb-4">欢迎来到严度平台</h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 float-md-right mt-6 mb-6">
                        <div class="card bg-secondary border-0 mb-0">
                            <div class="card-header bg-transparent ">
                                <div class="text-muted text-center "><small>登录</small></div>
                            </div>
                            <div class="card-body px-lg-5 py-lg-5">
                                <form   method="POST" id="login_form" class="margin-bottom-0" >
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="手机号码" type="text" name="username" id="username" value="{{old('username')}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="密码" type="password" name="password" id="password" value="{{old('password')}}">
                                        </div>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <button type="button" onclick="login_submit()" class="btn btn-primary btn-block my-4">登录</button>
                                </div>
                            </div>
                        </div>
                        {{--<div class="row mt-3">--}}
                            {{--<div class="col-6">--}}
                                {{--<a href="#" class="text-light"><small>忘记密码</small></a>--}}
                            {{--</div>--}}
                            {{--<div class="col-6 text-right">--}}
                                {{--<a href="#" class="text-light"><small>注册</small></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    </div>
                </div>


            </div>
        </div>

    </div>


    </div>

<!-- Footer -->
<footer class="footer py-2 bg-dark" >
    <div class="container col-md-10">
        <div class="row ">
            <div class="col-md-2">
                <div class="copyright text-center text-xl-left text-muted mt-2 mb-3">
                    <p  class="font-weight-bold ml-1" >关于我们</p>
                </div>
                <div class="copyright text-center text-xl-left  mt-2">
                    <a href="https://yd-hb.com/news_detail?id=122" class="font-weight-300 ml-1 text-sm text-muted" target="_blank">严度简介</a>
                </div>
                <div class="copyright text-center text-xl-left  mt-2">
                    <a href="https://yd-hb.com/news_detail?id=125" class="font-weight-300 ml-1 text-sm text-muted" target="_blank">发展历史</a>
                </div>
                <div class="copyright text-center text-xl-left  mt-2">
                    <a href="https://yd-hb.com/news_detail?id=126" class="font-weight-300 ml-1 text-sm text-muted" target="_blank">联系我们</a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="copyright text-center text-xl-left text-muted mt-2 md-3">
                    <p  class="font-weight-bold ml-1" >帮助中心</p>
                </div>
                <div class="copyright text-center text-xl-left  mt-2 ">
                    <a href="https://yandu.dev.chilunyc.com/news/join" class="font-weight-300 ml-1 text-sm text-muted" target="_blank">招商加盟</a>
                </div>
                <div class="copyright text-center text-xl-left  mt-2 ">
                    <a href="https://yd-hb.com/news_detail?id=127" class="font-weight-300 ml-1 text-sm text-muted" target="_blank">商家平台操作</a>
                </div>
                <div class="copyright text-center text-xl-left  mt-2 ">
                    <a href="https://yd-hb.com/news_detail?id=128" class="font-weight-300 ml-1 text-sm text-muted" target="_blank">广告位租赁</a>
                </div>

                <div class="copyright text-center text-xl-left  mt-2 ">
                    <a href="https://yandu.dev.chilunyc.com/news/platform" class="font-weight-300 ml-1 text-muted" target="_blank">平台说明</a>
                </div>
            </div>
            <div class="col-md-2 p-1">
                <div class="copyright text-center text-xl-left text-muted mt-2 mb-3">
                    <p  class="font-weight-bold ml-1" >平台服务</p>
                </div>
                <div class="copyright text-center text-xl-left  mt-2">
                    <a href="https://yd-hb.com/picc" class="font-weight-300 ml-1 text-sm text-muted" target="_blank">PICC保障</a>
                </div>
                <div class="copyright text-center text-xl-left  mt-2">
                    <a href="https://yd-hb.com/news_detail?id=129" class="font-weight-300 ml-1 text-sm text-muted" target="_blank">平台技术支持</a>
                </div>
                <div class="copyright text-center text-xl-left  mt-2">
                    <a href="https://yd-hb.com/news_detail?id=108" class="font-weight-300 ml-1 text-sm text-muted" target="_blank">全国CMA服务</a>
                </div>
                <div class="copyright text-center text-xl-left  mt-2">
                    <a href="" class="font-weight-300 ml-1 text-sm text-muted" target="_blank">加盟电话：4008-010-911</a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="copyright text-center text-xl-left text-muted mt-2">
                    <p  class="font-weight-bold ml-1" >友情链接</p>
                </div>
                <div class="copyright text-center text-xl-left  mt-2">
                    <a href="http://www.ciea.net.cn/" class="font-weight-300 ml-1 text-sm text-muted" target="_blank">中国室内环境协会
                    </a>
                </div>
                <div class="copyright text-center text-xl-left  mt-2">
                    <a href="http://www.ciega.org.cn/" class="font-weight-300 ml-1 text-sm text-muted" target="_blank">中国室内治理协会</a>
                </div>
                <div class="copyright text-center text-xl-left  mt-2">
                    <a href="http://www.cietc.com/" class="font-weight-300 ml-1 text-sm text-muted" target="_blank">室内环境网</a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="copyright  text-left text-muted text-center">
                    <p  class="font-weight-200 ml-1 text-xs " >严度测评公众号</p>
                    <img src="{{asset('assets/img/wechat_qrcode.png')}}"  style="width: 120px" />
                </div>
                {{--<div class="copyright text-center text-xl-left text-muted mt-2">--}}

                {{--</div>--}}

            </div>
            <div class="col-md-2">
                <div class="copyright  text-left text-muted text-center">
                    <p  class="font-weight-200 ml-1 text-xs " >严度测评小程序</p>
                    <img src="{{asset('assets/img/miniprogram_qrcodepng.png')}}"  style="width: 120px"/>

                </div>
                <div class="copyright text-center text-xl-left text-muted mt-2">
                </div>

            </div>
        </div>

    </div>
    <div class="container col-md-10">
        <hr class="simple mt-2 mb-2" color="#6f5499" />
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6">
                <div class="copyright text-center text-xl-left text-muted">
                     <p  class="font-weight-300 ml-1" >&copy; Copyright © 2019 严度测评 | 京ICP备19027114号-1</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Argon Scripts -->
<!-- Core -->
<script src="{{asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
<script src="{{ asset('assets/vendor/toastr/build/toastr.min.js') }}"></script>

<!-- Optional JS -->
<script src="{{asset('assets/vendor/onscreen/dist/on-screen.umd.min.js')}}"></script>
<!-- Argon JS -->
<script src="{{asset('assets/js/argon.js?v=1.1.0')}}"></script>
<!-- Demo JS - remove this in your project -->
<script src="{{asset('assets/js/demo.min.js')}}"></script>
<script>
    toastr.options = {
        closeButton: false,
        debug: false,
        progressBar: false,
        positionClass: "toast-top-center",
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",

    };
    {{--$(document).ready(function(){--}}
            {{--var ordertime= 120;   //设置再次发送验证码等待时间--}}
            {{--var timeleft=ordertime;--}}
            {{--var btn=$("#code");--}}


            {{--//计时函数--}}
            {{--function timeCount(){--}}
            {{--timeleft-=1--}}
            {{--if (timeleft>0){--}}
            {{--btn.val(timeleft+" 秒后重发");--}}
            {{--setTimeout(timeCount,1000)--}}
            {{--}--}}
            {{--else {--}}
            {{--btn.val("重新发送");--}}
            {{--timeleft=ordertime   //重置等待时间--}}
            {{--btn.removeAttr("disabled");--}}
            {{--}--}}
            {{--}--}}

            {{--//事件处理函数--}}
            {{--btn.on("click",function(){--}}

            {{--var email = document.getElementById('email').value;--}}
            {{--var password = document.getElementById('password').value;--}}
            {{--$(this).attr("disabled",true); //防止多次点击--}}
            {{--//此处可添加 ajax请求 向后台发送 获取验证码请求--}}
            {{--if (email != '' && password != ''){--}}
            {{--$.ajax({--}}
            {{--type: 'post',--}}
            {{--url: "{{ url('admin/login/code') }}",--}}
            {{--data: {'email':email},--}}
            {{--dataType: 'json',--}}
            {{--headers: {--}}
            {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--},--}}
            {{--success: function(data){--}}
            {{--if(data.message === 'ok'){--}}
            {{--toastr.success('验证码发送成功','');--}}
            {{--timeCount(this);--}}
            {{--}else {--}}
            {{--toastr.warning(data.message,'');--}}
            {{--btn.removeAttr("disabled");--}}
            {{--return false;--}}
            {{--}--}}
            {{--},--}}
            {{--error : function () {},--}}
            {{--});--}}
            {{--}else{--}}
            {{--toastr.warning('用户名密码不能为空');--}}
            {{--btn.removeAttr("disabled");--}}
            {{--}--}}
            {{--})--}}

            {{--})--}}
        document.onkeydown = function (e) { // 回车提交表单
// 兼容FF和IE和Opera
        var theEvent = window.event || e;
        var code = theEvent.keyCode || theEvent.which || theEvent.charCode;
        if (code === 13) {
            login_submit();
        }
    }

    function login_submit () {

        var form = new FormData($('#login_form')[0]);
        var url = "{{ route('login') }}";
        $.ajax({
            type: 'post',
            url: url,
            data: form,
            cache: false,
            processData: false,
            contentType: false,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                window.location.href = "{{ url('admin/home') }}";
            },
            error:function (data) {
                var json = JSON.parse(data.responseText);
                $.each(json.errors, function(idx, obj) {
                    toastr.warning(obj[0]);
                    // alert(obj[0]);
                    return false;
                });

            }
        })
    };

</script>
</body>

</html>