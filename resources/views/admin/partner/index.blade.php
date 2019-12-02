@extends('admin.layout.index')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-table/dist/bootstrap-table.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')}}">
@endsection
@section('contend_head')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">我合作的项目</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">首页</a></li>
                            </ol>
                        </nav>
                    </div>
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
                <div class="table-responsive py-4">
                    <table  class="table table-no-bordered table-striped"   id="table_id_example">
                        <thead class="thead-light">
                        <tr>
                            <th>项目名称</th>
                            {{--<th>项目状态</th>--}}
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
    <div class="row">
        <div class="col-md-4">
            <input type="hidden" class="btn btn-block btn-default" id="info" >
            <div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-labelledby="modal-info" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card bg-secondary shadow border-0">
                                <div class="card-header bg-transparent">
                                    <div class="text-muted text-center mt-2 mb-3"><label>提交验收报告</label></div>
                                    <div class="btn-wrapper text-center">
                                    </div>
                                </div>
                                <div class="card-body px-lg-5 py-lg-5">
                                    <div class="text-center text-muted mb-4">
                                        <small id="username"></small>
                                    </div>
                                    <form role="form" id="form">
                                        {{csrf_field()}}
                                        <input type="hidden" name="project_id" id="project_id" value="">
                                        <div class="form-group">
                                            <label class="form-control-label" for="content">上传验收报告文件</label>
                                            <input type="file" class="form-control">
                                        </div>
                                    </form>
                                    <div class="text-center">
                                        <button type="button" onclick="submit()" class="btn btn-primary my-4">提交</button>
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
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container',{
            zIndex:1055,
        });
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
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
                    url: '/admin/demand/partner/list',
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
                        // {title:'项目状态', field:'status',},
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
        function check(data) {
            $("#project_id").val(data);
            // 显示模态框
            $('#modal-info').modal('show');
        }

        function submit(){
            var form = new FormData($('#form')[0]);
            var url = "{{ route('demand.partner.check') }}";
            $.ajax({
                type: 'post',
                url: url,
                data: form,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(data){
                    Swal.fire(
                        '检测报告成功!',
                        '',
                        'success'
                    )
                    setTimeout(function(){
                        location.reload();
                    },1000);
                },
                error:function (data) {
                    var json = JSON.parse(data.responseText);

                }
            })
        }

        function confirm_check(id){
            Swal.fire({
                title: '是否确认?',
                text: "确认后退回押金!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '确认!',
                cancelButtonText:'取消'
            }).then((result) => {
                if (result.value) {
                    var url = "{{ route('demand.partner.confirm_check') }}";
                    $.ajax({
                        type: 'post',
                        url: url,
                        data: {'id':id},
                        dataType: 'json',
                        success: function(data){
                            Swal.fire(
                                '成功!',
                                '完成该项目',
                                'success'
                            )
                            setTimeout(function(){
                                location.reload();
                            },2000);
                        },
                        error:function (data) {
                            var json = JSON.parse(data.responseText);

                        }
                    });

                }
            })

        }
    </script>
@endsection