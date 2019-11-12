<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    {{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">--}}
    <link href="{{asset('web/css/docs.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/bootstrap.min.css')}}" rel="stylesheet">
    {{--<link href="{{asset('web/css/bootstrap.min.css')}}" rel="stylesheet">--}}
    {{--<link rel="stylesheet" href="{{asset('assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">--}}
    <link rel="stylesheet" href="{{asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/argon.css?v=1.1.0')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')}}">


    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <!--<script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>-->
    {{--<script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>--}}
    <![endif]-->
</head>
<body style="background-color: #ffffff">
<header class="navbar navbar-horizontal navbar-expand navbar-dark flex-row align-items-md-center ct-navbar  py-2" style="background-color: #ffffff">
    <div class="container">
        <a class="navbar-brand mr-0 mr-md-2" href="../../index.html" aria-label="Bootstrap">
            <img src="../../assets/img/brand/logo.png" style="height: 40px;">
            <sup>DOCS</sup>
        </a>
    </div>
</header>
<div class="bs-docs-header" >
    <div class="container">
        <h1 >{{$article->project_name}}</h1>
        <div id="badges-component" class="tab-pane tab-example-result fade active show" role="tabpanel" aria-labelledby="badges-component-tab">
            <span class="badge badge-info">{{$article->address}}</span>
            <span class="badge badge-success">招标公告</span>
            <span class="badge badge-warning">{{$article->budget.'元'}}</span>
        </div>
        <div style="    position: relative;
    width: 100%;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    padding: 10px 0;
    line-height: 26px;
    font-size: 14px;
    color: #999;
    text-align: left;
    margin-top: 10px;">
            <i class="fas fa-university"></i>
            <span style="margin-right: 40px;">发布单位：严度</span>
            <i class="fas fa-clock"></i>
            <span style="margin-right: 40px;">发布时间：{{$article->created_at}}</span>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-3"></div>
            <button type="button" class="btn btn-primary" onclick="submit()">对此项目感兴趣</button>
        </div>
        <form action="">
            <input type="hidden" name="user_id" id="user_id" value="@if(!empty($userId)){{$userId}}@endif" >
        </form>
    </div>

</div>
<div class="container bs-docs-container">

    <div class="row">
        <div class="col-md-12" role="main">
            <div class="bs-docs-section">

                {!! $article->content !!}
            </div>

        </div>

    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 id="sass" class="page-header">
                意向商户</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        {{--<th>商户名</th>--}}
                        {{--<th>工人信息</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        {{--<th scope="row"><code>lib/</code></th>--}}
                        <td>Ruby gem code (Sass configuration, Rails and Compass integrations)</td>
                    </tr>
                    <tr>
                        {{--<th scope="row"><code>tasks/</code></th>--}}
                        <td>Converter scripts (turning upstream Less to Sass)</td>
                    </tr>
                    <tr>
                        {{--<th scope="row"><code>test/</code></th>--}}
                        <td>Compilation tests</td>
                    </tr>
                    <tr>
                        {{--<th scope="row"><code>templates/</code></th>--}}
                        <td>Compass package manifest</td>
                    </tr>
                    <tr>
                        {{--<th scope="row"><code>vendor/assets/</code></th>--}}
                        <td>Sass, JavaScript, and font files</td>
                    </tr>
                    <tr>
                        {{--<th scope="row"><code>Rakefile</code></th>--}}
                        <td>Internal tasks, such as rake and convert</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="article_id" id="article_id" value="{{$article->id}}">

<div class="row">
    <div class="col-md-4">
        <input type="hidden" class="btn btn-block btn-default" id="login" data-toggle="modal" data-target="#modal-form">
        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card bg-secondary shadow border-0">
                            <div class="card-header bg-transparent pb-5">
                                <div class="text-muted text-center mt-2 mb-3"><small>登录</small></div>
                                <div class="btn-wrapper text-center">
                                    <img src="../../assets/img/brand/logo.png" alt="" style="width: 50%;">
                                </div>
                            </div>
                            <div class="card-body px-lg-5 py-lg-5">

                                <form role="form">
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="用户名/手机号" name="username" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="密码" name="password" type="password">
                                        </div>
                                    </div>

                                </form>

                                <div class="text-center">
                                    <button type="button" id="login_submit" class="btn btn-primary my-4">登录</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <input type="hidden" class="btn btn-block btn-default" id="info" >
        <div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-labelledby="modal-info" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card bg-secondary shadow border-0">
                            <div class="card-header bg-transparent pb-5">
                                <div class="text-muted text-center mt-2 mb-3"><small>成为意向商户</small></div>
                                <div class="btn-wrapper text-center">
                                </div>
                            </div>
                            <div class="card-body px-lg-5 py-lg-5">
                                <div class="text-center text-muted mb-4">
                                    <small id="username"></small>
                                </div>
                                <form role="form" id="form">
                                    {{csrf_field()}}
                                    <div class="container">
                                        <div class="row ">
                                            <label class="text-center text-muted mb-4" for="">选择工人</label>

                                            <div class="form-inline form-group col-md-12" id="worker">


                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <small>成为意向商户所需缴纳的押金（押金为该项目的1%）</small>
                                        <div class="input-group input-group-alternative">
                                            <input class="form-control" placeholder="" name="cash_deposit" type="text" id="cash_deposit" value="" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <input class="form-control" placeholder="" id="merchant_id" name="merchant_id" type="hidden" value="">
                                            <input class="form-control" placeholder="" id="project_id" name="project_id" type="hidden" value="">
                                        </div>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <button type="button" onclick="merchant()" class="btn btn-primary my-4">成为意向商户</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

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

<script>
    var id = $('#user_id').val();

    function submit() {
        if(!id){
            Swal.fire({
                title: '您还未登录',
                type: 'info',
                focusConfirm: false, //聚焦到确定按钮
                showCloseButton: true,//右上角关闭
                timer:2000
            });
            setTimeout(function() {
                // IE
                if(document.all) {
                    document.getElementById("login").click();
                }
                // 其它浏览器
                else {
                    var e = document.createEvent("MouseEvents");
                    e.initEvent("click", true, true);
                    document.getElementById("login").dispatchEvent(e);
                }
            },2000);

        }else{
                // IE
                if(document.all) {
                    document.getElementById("info").click();
                }
                // 其它浏览器
                else {
                    var e = document.createEvent("MouseEvents");
                    e.initEvent("click", true, true);
                    document.getElementById("info").dispatchEvent(e);
                }
       }
    }

    $("#info").click(function () {
        var url="{{route('info')}}";
        $.post(url,{
            'article_id': $('input[name=article_id]').val(),
            'merchant_id': id,
            '_token':'{{csrf_token()}}'
        }, function (data) {
            if (200 === data.code) {
                showQuery(data);
            } else {
                alert(data.message);
            }
        })
    });
    function showQuery(data) {
        $("#username").html(data.merchant_name);
        $("#worker").html(data.worker);
        $("#cash_deposit").val(data.cash_deposit);
        $("#merchant_id").val(data.merchant_id);
        $("#project_id").val(data.project_id);
        // 显示模态框
        $('#modal-info').modal('show');
    }

    function merchant(){
        var form = new FormData($('#form')[0]);
        var url = "{{ route('intention') }}";

        $.ajax({
            type: 'post',
            url: url,
            data: form,
            cache: false,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data){
                Swal.fire({
                    title: '微信支付!',
                    text: '请使用微信扫一扫\n' + '扫描二维码支付',
                    imageUrl: data.qrcode,
                    imageWidth: 300,
                    imageHeight: 300,
                    focusConfirm:false,
                    // imageAlt: 'Custom image',
                })
            }


        });
    }



    $("#login_submit").click(function () {

        var url = "{{ route('login') }}";
        $.post(url, {
            'username' : $('input[name=username]').val(),
            'password' : $('input[name=password]').val(),
            '_token' : '{{csrf_token()}}'
        }, function (data) {
            if (200 === data.code) {
                window.location.reload();
            } else {
                alert(data.msg);
            }
        })
    });
</script>
</body>
</html>