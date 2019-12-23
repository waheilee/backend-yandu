@extends('web.layout.app')
@section('detail')
    <div class="bs-docs-header" >
        <div class="container">
            <h1 >{{$article->project_name}}</h1>
            <div id="badges-component" class="tab-pane tab-example-result fade active show" role="tabpanel" aria-labelledby="badges-component-tab">
                <span class="badge badge-info">{{$article->province.'.'.$article->city.'.'.$article->county}}</span></br>
                <span class="badge badge-secondary">最低施工人数：{{$article->people_num}}人</span></br>
                <span class="badge badge-warning">{{exchangeToYuan($article->budget).'元'}}</span>
            </div>
            <div style="position: relative;
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
                <span style="margin-right: 40px;">发布时间：{{date('Y-m-d',strtotime($article->created_at)) }}</span>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-3"></div>
                @if(!$deposit and !$project)
                    <button type="button" class="btn btn-primary" onclick="submit()">对此项目感兴趣</button>
                @endif
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
            @if(!empty($merInfo))
                <div class="col-md-12">
                    <h1 id="sass" class="page-header">
                        意向商户</h1>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>商户名</th>
                                <th>工人信息</th>
                                <th>合作状态</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($merInfo as $value =>$k)
                                <tr >
                                    {{--<th scope="row"><code>lib/</code></th>--}}
                                    <td >{!! $k['merchant_name'] !!}</td>
                                    <td >
                                        @foreach($k['workers'] as $item =>$i)
                                            {{$i['worker_name']}}&nbsp;&nbsp;&nbsp;&nbsp;
                                        @endforeach
                                    </td>
                                    <td>
                                        {!! $k['status'] !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

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
                                        <img src="{{asset('assets/img/brand/logo.png')}}" alt="" style="width: 50%;">
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
                            <div class="card">
                                <img src="{{asset('assets/img/banner1.jpg')}}" alt="Image placeholder" class="card-img-top" style="height: 200px">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 order-lg-2">
                                        <div class="card-profile-image">
                                            <a href="#">
                                                <img src="" id="logo" class="rounded-circle">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">--}}
                                {{--<div class="d-flex justify-content-between">--}}
                                {{--<a href="#" class="btn btn-sm btn-info mr-4">Connect</a>--}}
                                {{--<a href="#" class="btn btn-sm btn-default float-right">Message</a>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                <div class="card-body pt-6">
                                    <div class="row">
                                        <div class="col">

                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <h3 class="h2" id="merchant_name">
                                            <span class="font-weight-light">, 27</span>
                                        </h3>
                                    </div>
                                </div>
                                <!-- Card header -->
                                <div class="card-header">
                                    <h3 class="mb-0">选择工人<span class="heading-title text-warning mb-0" id="peo" style="font-size: 1rem"></span></h3>
                                </div>
                                <!-- Card body -->
                                <div class="card-body">
                                    <form id="form">
                                        {{csrf_field()}}
                                        <div class="row" id="worker">

                                        </div>
                                        <div class="form-group">
                                            <h3 class="mb-0">成为意向商户所需缴纳的押金<span class="heading-title text-warning mb-0" style="font-size: 1rem">（押金为该项目的1%）</span></h3>
                                            <small>如成功竞标，项目结束双方确认验收后，会在三个工作日内退回押金；如流标，将于三个工作日内退回押金。</small>
                                            <div class="input-group input-group-alternative mt-4">
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
                                        <button class="btn"><img src="{{asset('web/images/aliapy.jpeg')}}" alt="" style="width: 100px; margin: 1px 50px;" onclick="alipay()"></button>
                                        <button class="btn"><img src="{{asset('web/images/WeChat.jpeg')}}" alt="" style="width: 100px; margin: 1px 50px;" onclick="wechat()"></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

@section('web_js')
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
                if (data.code === 200) {
                    showQuery(data);
                }else if(data.code === 403){
                    Swal.fire({
                        title: '提示',
                        text:''+data.message+'',
                        type: 'info',
                        focusConfirm: false, //聚焦到确定按钮
                        showCloseButton: true,//右上角关闭
                        showConfirmButton:true,
                        confirmButtonText:"前往工人添加页"
                        // timer:3000
                    }).then((result) => {
                        if (result.value) {
                            window.location.href="{{url('admin/worker/create')}}"
                        }
                    });
                    // alert(data.message);
                }else {
                    Swal.fire({
                        title: '提示',
                        text:''+data.message+'',
                        type: 'info',
                        focusConfirm: false, //聚焦到确定按钮
                        showCloseButton: true,//右上角关闭
                        showConfirmButton:false,
                        // timer:3000
                    })
                }
            })
        });
        function showQuery(data) {
            $("#merchant_name").html(data.merchant_name);
            $("#worker").html(data.worker);
            $("#cash_deposit").val(data.cash_deposit);
            $("#merchant_id").val(data.merchant_id);
            $("#project_id").val(data.project_id);
            $("#peo").html(data.people);
            $("#logo").attr('src',data.logo);
            // 显示模态框
            $('#modal-info').modal('show');
        }

        function wechat(){
            var form = new FormData($('#form')[0]);
            var url = "{{ route('intention') }}";
            form.append('pay_type','wechat');
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
                        imageUrl: data.scan.qrcode,
                        imageWidth: 300,
                        imageHeight: 300,
                        showConfirmButton:false,
                        // imageAlt: 'Custom image',
                    });
                    window.setInterval(function(){$.ajax({
                        type: 'post',
                        url:"{{route('notify')}}",
                        data: {'order':data.order.order_num},
                        cache: false,
                        processData: false,
                        contentType: false,
                        dataType:'json',
                        headers: {
                            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                        },
                        success:function(data) {
                            Swal.fire({
                                title: '提示',
                                text:''+data.message+'',
                                type: 'success',
                                focusConfirm: false, //聚焦到确定按钮
                                showCloseButton: true,//右上角关闭
                                showConfirmButton:false,
                                timer:2000
                            });
                            setTimeout(function() {
                                window.location.reload()
                            },2000);
                        }
                    })},3000);
                },
                error:function (data) {
                    var json = JSON.parse(data.responseText);
                    Swal.fire({
                        title: '未满足项目需求',
                        text: json.message,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        showConfirmButton:false,
                        cancelButtonText:'取消'
                    });
                    // toastr.warning(json.message,'修改失败');
                    return false;
                    // alert(data.message)
                }


            });
        }

        function alipay(){
            var form = new FormData($('#form')[0]);
            var url = "{{ route('intention') }}";
            form.append('pay_type','alipay');
            $.ajax({
                type: 'post',
                url: url,
                data: form,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(data){
                    console.log(data)
                    // Swal.fire({
                    //     title: '支付宝支付!',
                    //     text: '请使用支付宝扫一扫\n' + '扫描二维码支付',
                    //     imageUrl: data.qrcode,
                    //     imageWidth: 300,
                    //     imageHeight: 300,
                    //     showConfirmButton:false,
                    //     // imageAlt: 'Custom image',
                    // });
                    window.open("/alipay/"+data);
                    {{--window.setInterval(function(){$.ajax({--}}
                    {{--type: 'post',--}}
                    {{--url:"{{route('notify')}}",--}}
                    {{--data: form,--}}
                    {{--cache: false,--}}
                    {{--processData: false,--}}
                    {{--contentType: false,--}}
                    {{--dataType:'json',--}}

                    {{--success:function(data) {--}}
                    {{--Swal.fire({--}}
                    {{--title: '提示',--}}
                    {{--text:''+data.message+'',--}}
                    {{--type: 'success',--}}
                    {{--focusConfirm: false, //聚焦到确定按钮--}}
                    {{--showCloseButton: true,//右上角关闭--}}
                    {{--showConfirmButton:false,--}}
                    {{--timer:2000--}}
                    {{--});--}}
                    {{--setTimeout(function() {--}}
                    {{--window.location.reload()--}}
                    {{--},2000);--}}
                    {{--}--}}
                    {{--})},3000);--}}
                },
                error:function (data) {
                    var json = JSON.parse(data.responseText);
                    Swal.fire({
                        title: '未满足项目需求',
                        text: json.message,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        showConfirmButton:false,
                        cancelButtonText:'取消'
                    });
                    // toastr.warning(json.message,'修改失败');
                    return false;
                    // alert(data.message)
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

        function intention() {
            Swal.fire({
                title: '是否确认为合作商户',
                type: 'info',
                focusConfirm: false, //聚焦到确定按钮
                showCloseButton: true,//右上角关闭
                confirmButtonText: "确定",
            });
        }
    </script>
    @endsection