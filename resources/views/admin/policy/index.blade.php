@extends('admin.layout.index')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-table/dist/bootstrap-table.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')}}">
@endsection
@section('contend_head')
    <div class="header bg-yandu pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">XX保单</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{route('home')}}">首页</a></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">

                    </div>
                </div>
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">项目总数</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$row->policies}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="ni ni-active-40"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">保单剩余数量</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$row->policy_total}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                            <i class="ni ni-chart-pie-35"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">已使用保单</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$row->policy_used}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="ni ni-money-coins"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
@endsection
@section('contend')
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h3 class="mb-0">项目列表</h3>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <div class="fa-pull-right col-md-2">
                        <button type="button" class="btn btn-yandu  btn-block" data-toggle="modal" data-target="#modal-form">添加新项目</button>
                    </div>
                    <div class="table-responsive py-4">
                        <table  class="table table-no-bordered table-striped"   id="table_id_example">
                            <thead class="thead-light">
                            <tr>
                                {{--<th>序号</th>--}}
                                <th>公司名称</th>
                                <th>创建时间</th>
                                <th>分配保单数</th>
                                <th>已填写保单数</th>
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
            <input type="hidden" class="btn btn-block btn-default" id="info" >
            <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card bg-secondary shadow border-0">
                                <div class="card-header bg-transparent">
                                    <div class="text-muted text-center mt-2 mb-3"><label>项目添加</label></div>
                                    <div class="btn-wrapper text-center">
                                    </div>
                                </div>
                                <div class="card-body px-lg-5 py-lg-5">
                                    <div class="text-center text-muted mb-4">
                                        <small id="username"></small>
                                    </div>
                                    <form id="form">
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label form-control-label">项目名称</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="company" value="" id="company">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-search-input" class="col-md-2 col-form-label form-control-label">项目地址</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="address" value="" id="address">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-email-input" class="col-md-2 col-form-label form-control-label">配置保单数</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="number" name="total" value="" id="number" min="1" >
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" id="id" value="">
                                    </form>
                                    <div class="text-center" id="btn">
                                        <button type="button" onclick="submit()" class="btn btn-primary btn-block">提交</button>
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

@section('js')
    <script src="{{asset('assets/vendor/bootstrap-table/dist/bootstrap-table.js') }}"></script>
    <script src="{{asset('assets/vendor/bootstrap-table/dist/locale/bootstrap-table-zh-CN.js') }}"></script>
    <script src="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>

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
                    url: '/admin/policies/list',
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
                        // {title:'序号', field:'merchant_name',},
                        {title:'公司名称', field:'company',},
                        {title:'创建时间', field:'created_at',},
                        {title:'分配保单数', field:'policy_total',},
                        {title:'已填写保单数', field:'policy_used',},
                        {title:'邀请识别码', field:'code',},
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
        function submit(){
            var form = new FormData($('#form')[0]);
            var url = "{{ route('policy.create') }}";
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
                        position: 'top-end',
                        type: 'success',
                        title: ''+data.message+'',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    setTimeout(function(){
                        location.reload();
                    },1000);
                },
                error:function (data) {
                    var json = JSON.parse(data.responseText);
                    Swal.fire({
                        position: 'top-end',
                        type: 'warning',
                        title: json.message,
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
            })
        }

        function edit(id) {
            var url="{{route('policy.edit')}}";
            $.post(url,{
                'id': id,
                '_token':'{{csrf_token()}}'
            }, function (data) {
                showQuery(data);
            })
        };
        function showQuery(data) {
            $("#company").val(data.company);
            $("#address").val(data.address);
            $("#number").val(data.policy_total);
            $("#id").val(data.id);
            $("#btn").html("<button type=\"button\" onclick=\"submit_edit()\" class=\"btn btn-primary btn-block\">提交</button>");
            // 显示模态框
            $('#modal-form').modal('show');
        }

        function submit_edit(){
            var form = new FormData($('#form')[0]);
            var url = "{{ route('policy.update') }}";
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
                        position: 'top-end',
                        type: 'success',
                        title: ''+data.message+'',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    setTimeout(function(){
                        location.reload();
                    },1000);
                },
                error:function (data) {
                    var json = JSON.parse(data.responseText);
                    Swal.fire({
                        position: 'top-end',
                        type: 'warning',
                        title: json.message,
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
            })
        }
        
        function show_qrcode(img) {
            Swal.fire({
                imageUrl: img,
                imageHeight: 300,
                imageAlt: '保单二维码',
                confirmButtonText:'确定'
            })

        }
    </script>
    <script>
        function del(id) {
            Swal.fire({
                title: '确认是否删除?',
                text: "删除后无法找回",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '确定删除',
                cancelButtonText: '取消'
            }).then((result) => {
                if (result.value) {
                    var url = "{{ route('policy.delete') }}";
                    $.ajax({
                        type: 'post',
                        url: url,
                        data: {'id':id},
                        dataType: 'json',
                        success: function(data){
                            Swal.fire(
                                ''+data.message+'',
                                '',
                                'success'
                            );
                            setTimeout(function(){
                                location.reload();
                            },1000);
                        },
                        error:function (data) {
                            var json = JSON.parse(data.responseText);
                            Swal.fire(
                                ''+json.message+'',
                                '',
                                'warning'
                            );
                        }
                    })

                }
            })
        }
    </script>
    @endsection