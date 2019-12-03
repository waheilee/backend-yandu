@extends('admin.layout.index')
@section('css')
    {{--<link rel="stylesheet" href="{{asset('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">--}}
    {{--<link rel="stylesheet" href="{{asset('assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}">--}}
    {{--<link rel="stylesheet" href="{{asset('assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-table/dist/bootstrap-table.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')}}">
@endsection
@section('contend_head')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">发布需求列表</h6>
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
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">

                </div>
                <div class="card-body">
                    <div class="table-responsive py-4">
                        <table  class="table table-no-bordered table-striped"   id="table_id_example">
                            <thead class="thead-light">
                            <tr>
                                <th>项目名称</th>
                                <th>项目地点</th>
                                <th>项目大小(单位:平米)</th>
                                <th>项目标的(单位:元)</th>
                                <th>项目周期(单位：天)</th>
                                <th>施工人数</th>
                                <th>项目发布时间</th>
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

    <div class="row">
        <div class="col-md-4">
            <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal-modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">

                        <div class="modal-body p-0">

                            <div class="card">
                                <!-- Card header -->
                                <div class="card-header border-0">
                                    <h3 class="mb-0">对此项目有意向商户</h3>
                                </div>
                                <!-- Light table -->
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name">Project</th>
                                            <th scope="col" class="sort" data-sort="budget">Budget</th>
                                            <th scope="col" class="sort" data-sort="status">Status</th>
                                            <th scope="col">Users</th>
                                            <th scope="col" class="sort" data-sort="completion">Completion</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody class="list">
                                        <tr>
                                            <th scope="row">
                                                <div class="media align-items-center">
                                                    <input class="custom-control custom-checkbox mr-3" type="checkbox" value="id">
                                                    {{--<a href="#" class="avatar rounded-circle mr-3">--}}
                                                        {{----}}
                                                        {{--<img alt="Image placeholder" src="../../assets/img/theme/bootstrap.jpg">--}}
                                                    {{--</a>--}}
                                                    <div class="media-body">
                                                        <span class="name mb-0 text-sm">Argon Design System</span>
                                                    </div>
                                                </div>
                                            </th>
                                            <td class="budget">
                                                $2500 USD
                                            </td>
                                            <td>
                                              <span class="badge badge-dot mr-4">
                                                <i class="bg-warning"></i>
                                                <span class="status">pending</span>
                                              </span>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <a href="#" onclick="info()" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="姓名">
                                                        <img alt="Image placeholder" src="../../assets/img/theme/team-1.jpg">
                                                    </a>
                                                    <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                                                        <img alt="Image placeholder" src="../../assets/img/theme/team-2.jpg">
                                                    </a>
                                                    <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                                                        <img alt="Image placeholder" src="../../assets/img/theme/team-3.jpg">
                                                    </a>
                                                    <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                                                        <img alt="Image placeholder" src="../../assets/img/theme/team-4.jpg">
                                                    </a>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="completion mr-2">60%</span>
                                                    <div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- Card footer -->
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-icon text-blue ml-auto" data-dismiss="modal">Close</button>
                                </div>
                        </div>

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
        function info(){
            // var content = "无记录";
            // var msg=""; //msg 是从外面传入的数据

            // if (msg) {

                content = "<p style='color: red'>最近一次操作后的5小时内有效</p> "
                    + "<p>可以使用 Ctrl +F 查找关键字</p>"
                    + "<table class='table'>"
                    + "<tr>"
                    + "     <th class='js_tr_data'> 时间</th> <th>名称</th> <th>密码</th><th>密码</th><th>密码</th><th>密码</th><th>密码</th>"
                    + "</tr>"
                    + "<tr>"
                    + "     <td class='js_tr_data'> 2011</td> <td>aa</td> <td>123</td><td>123</td><td>123</td><td>123</td><td>123</td>"
                    + "</tr>"
                    + "<tr>"
                    + "     <td class='js_tr_data'> 2012</td> <td>bb</td> <td>123</td><td>123</td><td>123</td><td>123</td><td>123</td>"
                    + "</tr>"
                    + "<tr>"
                    + "     <td class='js_tr_data'> 2013</td> <td>cc</td> <td>123</td><td>123</td><td>123</td><td>123</td><td>123</td>"
                    + "</tr>"
                    // + msg
                    + "</table>"
            // }

            Swal.fire({
                title: '<strong>记录</strong>',
                type: 'info',
                html: content, // HTML
                focusConfirm: true, //聚焦到确定按钮
                showCloseButton: true,//右上角关闭
            })

        }
    </script>
    <script>
        $(function () {

            //1.初始化Table
            var oTable = new TableInit();
            oTable.Init();

            //2.初始化Button的点击事件
            // var oButtonInit = new ButtonInit();
            // oButtonInit.Init();

        });

        var TableInit = function () {
            var oTableInit = new Object();
            //初始化Table
            oTableInit.Init = function () {
                $('#table_id_example').bootstrapTable({
                    url: '/admin/project/list',
                    // method: 'get',                      //请求方式（*）
                    //toolbar: '#toolbar',                //工具按钮用哪个容器
                    //striped: true,                      //是否显示行间隔色
                    cache: false,                       //是否使用缓存，默认为true，所以一般情况下需要设置一下这个属性（*）
                    pagination: true,                   //是否显示分页（*）
                    // sortable: false,                     //是否启用排序
                    // sortOrder: "asc",                   //排序方式
                    queryParams: oTableInit.queryParams,//传递参数（*）
                    sidePagination: "server",           //分页方式：client客户端分页，server服务端分页（*）
                    pageNumber:1,                       //初始化加载第一页，默认第一页
                    pageSize: 15,                       //每页的记录行数（*）
                    pageList: [10, 25, 50, 100],        //可供选择的每页的行数（*）
                    //search: true,                       //是否显示表格搜索，此搜索是客户端搜索，不会进服务端，所以，个人感觉意义不大
                    //strictSearch: true,
                    showColumns: false,                  //是否显示所有的列
                    showRefresh: false,                  //是否显示刷新按钮
                    minimumCountColumns: 2,             //最少允许的列数
                    clickToSelect: true,                //是否启用点击选中行
                    height: 800,                        //行高，如果没有设置height属性，表格自动根据记录条数觉得表格高度
                    //uniqueId: "ID",                     //每一行的唯一标识，一般为主键列
                    //showToggle:true,                    //是否显示详细视图和列表视图的切换按钮
                    //cardView: false,                    //是否显示详细视图
                    //detailView: false,                   //是否显示父子表
                    columns:[
                        {title:'项目名称', field:'project_name',},
                        {title:'项目地点', field:'address',},
                        {title:'项目大小(单位:平米)', field:'size',},
                        {title:'项目标的(单位:元)', field:'budget',},
                        {title:'项目周期(单位：天)', field:'project_time',},
                        {title:'施工人数', field:'people_num',},
                        {title:'项目发布时间', field:'begin_time',},
                        {title:'操作', field:'button',},
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
        function del(id) {
            Swal.fire({
                title: '是否确定删除?',
                text: "删除后将无法找回!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '确定',
                cancelButtonText: '取消'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type:'post',
                        url:'delete',
                        data:{'id':id},
                        dataType: 'json',
                        headers: {
                            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                        },
                        success : function (data) {
                            Swal.fire({
                                title: data.message,
                                type: 'success',
                                focusConfirm: false, //聚焦到确定按钮
                                showCloseButton: true,//右上角关闭
                                confirmButtonText: '确定',
                                // timer: 2000
                            }),
                            $('#table_id_example').bootstrapTable('refresh', {url: '/admin/project/list'});
                        },
                    })
                }
            })

        }
    </script>
    @endsection