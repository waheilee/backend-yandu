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
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white">Hello Jesse</h1>
                    <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
                    <a href="{{route('employer')}}" class="btn btn-neutral" target="_blank">购买雇员责任险</a>
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
                                <th>邮箱</th>
                                <th>职位</th>
                                <th>薪资范围</th>
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
                    url: '{{route('policy.showList')}}',
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
                        {title:'邮箱', field:'email',},
                        {title:'职位', field:'position',},
                        {title:'薪资范围', field:'payroll',},
                        {title:'提交时间', field:'created_at',},
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
    </script>
@endsection