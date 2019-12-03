@extends('admin.layout.index')
@section('css')
    <link href="{{asset('assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/build/toastr.css') }}">
    <link rel="stylesheet" href="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')}}">



@endsection
@section('contend_head')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">我要派单</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">首页</a></li>
                            </ol>
                        </nav>
                    </div>
                    {{--<div class="col-lg-6 col-5 text-right">--}}
                    {{--<a href="#" class="btn btn-sm btn-neutral">New</a>--}}
                    {{--<a href="#" class="btn btn-sm btn-neutral">Filters</a>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
@endsection
@section('contend')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-wrapper">
                <!-- Form controls -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">发布需求</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body col-md-8 center">
                        <form id="project_form">
                            <div class="form-group">
                                <label class="form-control-label" for="">项目名称</label>
                                <input type="text" class="form-control" name="project_name" id="project_name" placeholder="项目名称">
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group " >
                                        <label class="form-control-label">项目省分 </label>
                                        <select class="form-control" id="s_province" name="s_province" ></select> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group " >
                                        <label class="form-control-label">市 </label>
                                        <select class="form-control" id="s_city" name="s_city" ></select> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group " >
                                        <label class="form-control-label">县 </label>
                                        <select class="form-control" id="s_county" name="s_county" ></select> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="">详细地址</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="项目详细地点">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group date" id="begin_time">
                                        <label class="form-control-label" for="begin_time">项目开始时间</label>
                                        <input class="form-control" type="text" value="{{date("Y-m-d",time())}}" name="begin_time" >
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group date" id="end_time">
                                        <label class="form-control-label" for="end_time">项目预计结束时间</label>
                                        <input class="form-control" type="text" value="{{date("Y-m-d",time())}}" name="end_time" >
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="size">项目大小(平米数)</label>
                                <input type="text" class="form-control" name="size" id="size" placeholder="施工面积大小">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="budget">项目预算价格</label>
                                <input type="text" class="form-control" id="budget" name="budget" placeholder="本项目预算价格">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="cash_deposit">保证金金额(乙方所需缴纳的保证金额,根据项目预算的1%手续)</label>
                                <input type="text" class="form-control" id="cash_deposit" name="cash_deposit" value="" placeholder="" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="people_num">根据项目大小最低使用人数</label><span class="heading-title text-warning mb-0" id="peo" style="font-size: 1rem"></span>
                                <input type="text" class="form-control" name="people_num" id="people_num" placeholder="乙方必须达到最低使用人数才能参加本项目">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="phone">联系方式</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="4008-010-911" value="4008-010-911" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="content">项目详细介绍</label>
                                <script id="container" name="content" type="text/plain"></script>
                            </div>
                            {{--<div class="row">--}}
                                {{--<div class="col-xs">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<input class="" type="checkbox"  value="1" name="state" id="state">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<a href="" data-toggle="modal" data-target="#modal-default">《平台XXXXXXXXX申明》</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </form>
                        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="submit()">提交</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">《平台XXXXXX申明》</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body" style="max-height: 500px; overflow-y:auto;">
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p><p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p><p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p><p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                        </div>

                        <div class="modal-footer">
                            {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                            <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.zh-CN.min.js')}}"></script>
    <script src="{{asset('assets/vendor/moment/min/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('assets/vendor/toastr/build/toastr.min.js') }}"></script>
    <script src="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('assets/js/area.js')}}" type="text/javascript"></script>
    <script type="text/javascript">_init_area();</script>
    <script type="text/javascript">

        // var Gid  = document.getElementById ;
        //
        // var showArea = function(){
        //
        //     Gid('show').innerHTML = "<h3>省" + Gid('s_province').value + " - 市" +
        //
        //         Gid('s_city').value + " - 县/区" +
        //
        //         Gid('s_county').value + "</h3>"
        //
        // }

        // Gid('s_county').setAttribute('onchange','showArea()');

    </script>

    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });


    </script>
    <script>
        $('#budget').on('blur',function(){
            var budget = document.getElementById('budget').value;
            var cash_deposit = budget*0.01
            $("#cash_deposit").attr("value",cash_deposit);
            // document.getElementById('cash_deposit').value=cash_deposit;
        });
        $('#size').on('blur',function(){
            var size = document.getElementById('size').value;
            var worker = get_worker_num(size);
            // console.log(worker)
            $("#peo").html("(建议使用人数:"+worker+"人)");
            // document.getElementById('cash_deposit').value=cash_deposit;
        });
        function get_worker_num(num){
            var str ="";
            if (num<500) {
                str=2
            }else if(num>500 && num<1000){
                str=3;
            }else if(num>1000 && num<5000){
                str=4;
            }else if(num>5000 && num<20000){
                str=5;
            }else if(num>20000 && num<50000){
                str=8;
            }else if(num>50000 && num<200000){
                str=10;
            }else if(num>200000){
                str=15
            }

            return str;
        }
        $("#begin_time").datepicker({
            format: 'yyyy-mm-dd',//格式
            minView:'month',//最小显示的控件
            language: 'zh-CN',//显示的语言
            autoclose:true//自动关闭
        })
        $("#end_time").datepicker({
            format: 'yyyy-mm-dd',//格式
            minView:'month',//最小显示的控件
            language: 'zh-CN',//显示的语言
            autoclose:true//自动关闭
        })

    </script>
    <script>
    function submit(){
        var project_name = document.getElementById('project_name').value;
        var address = document.getElementById('address').value;
        var begin_time = document.getElementById('begin_time').value;
        var end_time = document.getElementById('end_time').value;
        var size = document.getElementById('size').value;
        var budget = document.getElementById('budget').value;
        var people_num = document.getElementById('people_num').value;
        if(project_name === '') {toastr.warning('请填写项目名称');return false;}
        if(address === '') {toastr.warning('请填写项目地址');return false;}
        if(begin_time === '') {toastr.warning('请选择项目开始时间');return false;}
        if(end_time === '') {toastr.warning('请选择项目结束时间');return false;}
        if(size === '') {toastr.warning('请填写项目大小');return false;}
        if(budget === '') {toastr.warning('项目预算为多少？');return false;}
        if(people_num === '') {toastr.warning('本项目最低需要几人？');return false;}
        // if(!$("input[type='checkbox']").prop('checked')){toastr.warning('我同意《我同意xxxxxx申明》');return false;}

        // if($('input[name="state"]').prop("checked")){toastr.warning('请阅读申明后勾选申明');return false;}

        var formData = new FormData($('#project_form')[0]);

        $.ajax({
            type: 'POST',
            url: '/admin/project/create',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            dataType: 'json',
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            },
            success : function (data) {
                if(data.status){
                    Swal.fire({
                        title: data.message,
                        type: 'success',
                        focusConfirm: false, //聚焦到确定按钮
                        showCloseButton: true,//右上角关闭
                        timer: 2000
                    })
                    setTimeout(function(){
                        location.href = '{{url('admin/project/index')}}';
                    },2000);
                }else {
                    $.each(data.errors, function(idx, obj) {
                        layer.msg(obj[0]);
                        // alert(obj[0]);
                        return false;
                    });
                }
            }
        })

    }
    </script>

@endsection