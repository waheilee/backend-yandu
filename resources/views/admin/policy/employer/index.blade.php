@extends('admin.layout.index')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-table/dist/bootstrap-table.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')}}">
@endsection
@section('contend_head')
    {{--<div class="header bg-yandu pb-6">--}}
        {{--<div class="container-fluid">--}}
            {{--<div class="header-body">--}}
                {{--<div class="row align-items-center py-4">--}}
                    {{--<div class="col-lg-6 col-7">--}}
                        {{--<h6 class="h2 text-white d-inline-block mb-0">雇主责任险</h6>--}}
                        {{--<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">--}}
                            {{--<ol class="breadcrumb breadcrumb-links breadcrumb-dark">--}}
                                {{--<li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>--}}
                                {{--<li class="breadcrumb-item"><a href="{{route('home')}}">首页</a></li>--}}
                            {{--</ol>--}}
                        {{--</nav>--}}
                    {{--</div>--}}
                    {{--<div class="col-lg-6 col-5 text-right">--}}

                    {{--</div>--}}
                {{--</div>--}}
                {{--<!-- Card stats -->--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(../../assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-yandu "></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white">雇主责任险</h1>
                    <p class="text-white  text-sm">老板事业护身符 减负首选</p>
                    <p class="text-white  text-sm">员工有保险 工作有保障 干活更安心</p>

                    <p class="text-white mb-0 text-sm">保险介绍：</p>
                    <p class="text-white text-sm">在保险期间内，被保险人在其雇佣期间因从事保险单所载明的被保险人的工作而遭受意外事故或患与工作有关的国家规定的职业性疾病所致伤、残或死亡，符合国务院颁布的《工伤保险条例》第十四条、第十五条规定可认定为工伤的，依照中华人民共和国法律（不包括港澳台地区法律）应由被保险人承担的经济赔偿责任，保险人按照本保险合同约定进行死亡赔偿、伤残赔偿、医疗费用、误工费用等进行赔偿。</p>
                    <div class="row">
                        <div class="col">
                            <p class="text-white mb-0 text-sm">保险亮点：</p>
                            <p class="text-white mb-0 text-sm">1、	保障员工工作期间意外</p>
                            <p class="text-white text-sm">意外事故10万保额，职业病10万保额</p>
                        </div>
                        <div class="col">
                            <p class="text-white mb-0 text-sm">2、	医疗费用 赔付门槛低</p>
                            <p class="text-white text-sm">工作期间意外产生的医疗费用，保额1万</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="text-white mb-0 text-sm">3、	误工津贴保障</p>
                            <p class="text-white text-sm">误工费180天</p>
                        </div>
                        <div class="col">
                            <p class="text-white mb-0 text-sm">4、	贴心的售后服务</p>
                            <p class="text-white text-sm">电子保单，保险自动到期提醒</p>
                        </div>
                    </div>
                </div>
                <div class="col mt-6">
                    <a href="{{route('employer')}}" class="btn btn-neutral " target="_blank">购买雇员责任险</a>

                </div>

            </div>
        </div>
    </div>
    <!-- Page content -->
@endsection
@section('contend')
    <div class="row">
        <a href="" target=""></a>
        <div class="col-xl-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h3 class="mb-0">项目保单列表</h3>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <div class="table-responsive py-4">
                        <table  class="table table-no-bordered table-striped"   id="table_id_example">
                            <thead class="thead-light">
                            <tr>
                                <th>保单号</th>
                                <th>投保人姓名</th>
                                <th>身份证号</th>
                                <th>手机</th>
                                <th>保单状态</th>
                                <th>职位</th>
                                <th>提交时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

@section('js')
    <script src="{{asset('assets/vendor/bootstrap-table/dist/bootstrap-table.js') }}"></script>
    <script src="{{asset('assets/vendor/bootstrap-table/dist/locale/bootstrap-table-zh-CN.js') }}"></script>
    <script src="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>

    <script>
        $(function () {
            //1.初始化Table
            var oTable = new TableInit();
            oTable.Init();
        });
        var TableInit = function () {
            var oTableInit = new Object();
            //初始化Table
            oTableInit.Init = function () {
                $('#table_id_example').bootstrapTable({
                    url: '{{route('employer.list')}}',
                    cache: false,                       //是否使用缓存，默认为true，所以一般情况下需要设置一下这个属性（*）
                    pagination: true,                   //是否显示分页（*）
                    queryParams: oTableInit.queryParams,//传递参数（*）
                    sidePagination: "server",           //分页方式：client客户端分页，server服务端分页（*）
                    pageNumber:1,                       //初始化加载第一页，默认第一页
                    pageSize: 15,                       //每页的记录行数（*）
                    pageList: [10, 25, 50, 100],        //可供选择的每页的行数（*）
                    showColumns: false,                  //是否显示所有的列
                    showRefresh: false,                  //是否显示刷新按钮
                    minimumCountColumns: 2,             //最少允许的列数
                    clickToSelect: true,                //是否启用点击选中行
                    height: 500,                        //行高，如果没有设置height属性，表格自动根据记录条数觉得表格高度
                    columns:[
                        {title:'保单号', field:'policy_no',},
                        {title:'投保人姓名', field:'username',},
                        {title:'身份证号', field:'idcard',},
                        {title:'手机', field:'phone',},
                        {title:'保单状态', field:'pay_status',},
                        {title:'技能', field:'position',},
                        {title:'生效时间', field:'effective_date',},
                        {title:'过期时间', field:'out_time',},
                        {title:'操作操作', field:'button',},
                    ]
                });
            };

            //得到查询的参数
            oTableInit.queryParams = function (params) {
                var temp = {   //这里的键的名字和控制器的变量名必须一直，这边改动，控制器也需要改成一样的
                    limit: params.limit,   //每页显示数量
                    offset: params.offset,  //页码  SQL语句起始索引
                    page: (params.offset / params.limit) + 1,   //当前页码

                };
                return temp;
            };
            return oTableInit;
        };
    </script>
    <script>
        function show_policy_img(img) {
            Swal.fire({
                imageUrl: img,
                imageHeight: 700,
                imageWidth:600,

                imageAlt: '保单二维码',
                confirmButtonText:'确定'
            })

        }

        function pay(order) {
            $.ajax({
                type: 'POST',
                url: '{{route('employer.renewPay')}}',
                data: {'order':order},
                dataType: 'json',
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                success : function (data) {
                    window.open("{{url('policy/employer/pay/')}}"+"/"+data)
                },
                error : function (data) {
                    var json = JSON.parse(data.responseText);

                    $.each(json.errors, function(idx, obj) {
                        toastr.warning(obj[0]);
                        return false;
                    });
                }
            })
        }
    </script>
@endsection