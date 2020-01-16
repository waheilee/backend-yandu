@extends('se_new.layout.index')
@section('se_new_css')
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-table/dist/bootstrap-table.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')}}">
@endsection
@section('se_new_contend_head')

    {{--<a href="{{route('employer')}}"  target="_blank">--}}
        {{--<div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(/../../assets/img/employer.jpeg); background-size: cover; background-position: center top;">--}}
            {{--<!-- Mask -->--}}
            {{--<span class="mask  "></span>--}}
            {{--<!-- Header container -->--}}
        {{--</div>--}}
    {{--</a>--}}
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">

                    </div>
                    {{--<div class="col-lg-6 col-5 text-right">--}}
                        {{--<a href="#" class="btn btn-sm btn-neutral">New</a>--}}
                        {{--<a href="#" class="btn btn-sm btn-neutral">Filters</a>--}}
                    {{--</div>--}}
                </div>
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">总保单数</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$total}}</span>
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
                                        <h5 class="card-title text-uppercase text-muted mb-0">已使用保单数</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$use}}</span>
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
                                        <h5 class="card-title text-uppercase text-muted mb-0">剩余保单数</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$surplus}}</span>
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
@section('se_new_contend')
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
                                <th>姓名</th>
                                <th>电话</th>
                                <th>保单号</th>
                                <th>有效时间</th>
                                <th>保单状态</th>
                                <th>续保次数</th>
                                {{--<th>工作年限</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="modal-policy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">除醛送保单服务个人信息填写</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mb-0">
                    <form role="form" id="policy">
                        <div id="order">

                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="">邀请识别码</label>
                                    <input class="form-control " placeholder="邀请识别码" name="code" type="text" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="">姓名<span class="text-danger">*</span></label>
                                    <input class="form-control" placeholder="姓名" name="name" type="text" id="name" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="">身份证号<span class="text-danger">*</span></label>
                                    <input class="form-control" placeholder="身份证号" name="idcard" type="text" id="idcard" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="">手机号码<span class="text-danger">*</span></label>
                                    <input class="form-control" placeholder="手机号码" name="phone" type="text" id="phone" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="">邮箱</label>
                                    <input class="form-control" placeholder="邮箱" name="email" type="email" id="email" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="">施工技能<span class="text-danger">*</span></label>
                                    <input class="form-control" placeholder="例：除甲醛、保洁..." name="position" type="text" id="position" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <label class="form-control-label" for="">数量<span class="text-danger">*</span></label>
                                <input class="form-control" id=txtAmount name="number" value="0" type="number"  min="1"
                                       onkeyup="checkInt(this);" onpaste="checkInt(this);" oncut="checkInt(this);"
                                       ondrop="checkInt(this);" onchange="checkInt(this);" placeholder="购买保单数量">

                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <h2 class="text-lg text-danger" style="margin-top: 37px;margin-bottom: 0px;" id="num"></h2>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="modal-footer mt-1">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-danger" onclick="submit()">购买雇主责任险</button>
                </div>
            </div>
        </div>
    </div>
        <div class="modal fade" id="modal-img" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="width: 815px">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="policy_image"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('se_new_js')
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
                    url: '/admin/se_new/worker/list',
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
                        {title:'姓名', field:'name',},
                        {title:'电话', field:'phone',},
                        {title:'保单号', field:'policy_no',},
                        {title:'有效时间', field:'effective_time',},
                        {title:'保单状态', field:'status',},
                        {title:'续保次数', field:'renewal',},
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
        function policy(id) {

    Swal.fire({
        title: '购买保险份数（每份为期一个月）',
        input: 'number',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        showLoaderOnConfirm: true,

    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: '{{url('admin/se_new/worker/policy')}}',
                data: {'number':result.value,'worker_id':id},
                dataType: 'json',
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                success : function (data) {
                    Swal.fire('保单添加成功', '', 'success')
                    setTimeout(function(){
                        location.reload();
                    },1000);
                },
                error : function (data) {
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
        console.log(result.value)

    })
}
        function gopay(order) {

        }

        function repay(order) {
            $.ajax({
                type: 'POST',
                url: '{{route('employer.rePay')}}',
                data: {'order':order},
                dataType: 'json',
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                success : function (data) {
                    showQuery(data);
                    {{--window.open("{{url('policy/employer/pay/')}}"+"/"+data)--}}
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

        function showQuery(data) {
            $("#name").val(data.username);
            $("#idcard").val(data.idcard);
            $("#phone").val(data.phone);
            $("#email").val(data.email);
            $("#position").val(data.position);
            $("#order").html("<input type=\"hidden\" name=\"order\" id=\"order\" value='"+data.order_no+"'>",);
            // 显示模态框
            $('#modal-policy').modal('show');
        }
        document.getElementById("txtAmount").addEventListener("input",function(event){
            event.target.value = event.target.value.replace(/\-/g,"");
        });
        function checkInt(o){
            theV=isNaN(parseInt(o.value))?0:parseInt(o.value);
            let food = '';
            if(theV!=o.value){o.value=theV;}
            if (txtAmount.value >= 6 && txtAmount.value < 12) {
                food = txtAmount.value*20*0.85
            } else if (txtAmount.value >= 12) {
                food = txtAmount.value*20*0.75
            } else {
                food = txtAmount.value*20;
            }
            $('#num').html('￥'+food)

        }

        function submit() {
            var formData = new FormData($('#policy')[0]);
            $.ajax({
                type: 'POST',
                url: '{{route('employer.store')}}',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content')},
                success : function (data) {
                    window.open("{{url('policy/employer/pay/')}}"+"/"+data)
                },
                error : function (data) {
                    var json = JSON.parse(data.responseText);
                    $.each(json.errors, function(idx, obj) {
                        toastr.warning(obj);
                        return false;
                    });
                }
            })
        }

        function policy_image(data) {
            $("#policy_image").html("<img src='"+data+"' style='width: 800px'>");
            // 显示模态框
            $('#modal-img').modal('show');
        }
    </script>
@endsection