<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Argon Dashboard PRO - Premium Bootstrap 4 Admin Template</title>
    <!-- Favicon -->
    <link rel="icon" href="{{asset('assets/img/brand/favicon.png')}}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/build/toastr.css') }}">

    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/argon.css?v=1.1.0')}}" type="text/css">
</head>
<body class="bg-default">
<!-- Navbar -->
<nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
</nav>
<!-- Main content -->
<div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                        <h1 class="text-white">严度派</h1>
                        <p class="text-lead text-white">Use these awesome forms to login or create new account in your project for free.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>Or sign in with credentials</small>
                        </div>
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
                            {{--<div class="custom-control custom-control-alternative custom-checkbox">--}}
                                {{--<input class="custom-control-input" id=" customCheckLogin" type="checkbox">--}}
                                {{--<label class="custom-control-label" for=" customCheckLogin">--}}
                                    {{--<span class="text-muted">Remember me</span>--}}
                                {{--</label>--}}
                            {{--</div>--}}
                            <div class="text-center">
                                <button type="button" id="login_submit" class="btn btn-primary my-4">登录</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <a href="#" class="text-light"><small>忘记密码</small></a>
                    </div>
                    <div class="col-6 text-right">
                        <a href="#" class="text-light"><small>注册</small></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="py-5" id="footer-main">
    <div class="container">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6">
                <div class="copyright text-center text-xl-left text-muted">
                    &copy; 2019 <a href="" class="font-weight-bold ml-1" target="_blank">严度</a>
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
    $(document).ready(function(){
        var ordertime= 120;   //设置再次发送验证码等待时间
        var timeleft=ordertime;
        var btn=$("#code");


        //计时函数
        function timeCount(){
            timeleft-=1
            if (timeleft>0){
                btn.val(timeleft+" 秒后重发");
                setTimeout(timeCount,1000)
            }
            else {
                btn.val("重新发送");
                timeleft=ordertime   //重置等待时间
                btn.removeAttr("disabled");
            }
        }

        //事件处理函数
        btn.on("click",function(){

            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            $(this).attr("disabled",true); //防止多次点击
            //此处可添加 ajax请求 向后台发送 获取验证码请求
            if (email != '' && password != ''){
                $.ajax({
                    type: 'post',
                    url: "{{ url('admin/login/code') }}",
                    data: {'email':email},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        if(data.message === 'ok'){
                            toastr.success('验证码发送成功','');
                            timeCount(this);
                        }else {
                            toastr.warning(data.message,'');
                            btn.removeAttr("disabled");
                            return false;
                        }
                    },
                    error : function () {},
                });
            }else{
                toastr.warning('用户名密码不能为空');
                btn.removeAttr("disabled");
            }
        })

    })


    $("#login_submit").click(function () {
        {{--var phone = document.getElementById('username').value;--}}
        {{--var password = document.getElementById('password').value;--}}

        {{--if (isNaN(password)){--}}
            {{--toastr.warning('密码不能为空','');--}}
            {{--return false;--}}
        {{--}--}}
        {{--var formData = new FormData($('#login_form')[0]);--}}

        {{--$.ajax({--}}
            {{--type: 'post',--}}
            {{--url: "{{ url('admin/login') }}",--}}
            {{--data: formData,--}}
            {{--cache: false,--}}
            {{--processData: false,--}}
            {{--contentType: false,--}}
            {{--dataType: 'json',--}}
            {{--success: function(data){--}}
                {{--if(data.message === 'ok'){--}}
                    {{--setTimeout(function(){--}}
                        {{--location.href = '{{url('admin/home')}}';--}}
                    {{--},1);--}}
                {{--}else {--}}
                    {{--toastr.warning(data.message);--}}
                {{--}--}}
            {{--},--}}
        {{--});--}}
        var url = "{{ route('login') }}";
            $.post(url, {
                'username' : $('input[name=username]').val(),
                'password' : $('input[name=password]').val(),
                '_token' : '{{csrf_token()}}'
            }, function (data) {
                if (200 === data.code) {
                    window.location.href = "{{ url('admin/home') }}";
                } else {
                    alert(data.msg);
                }
            })
    });

</script>
</body>

</html>