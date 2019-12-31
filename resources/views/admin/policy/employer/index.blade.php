@extends('admin.layout.index')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-table/dist/bootstrap-table.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')}}">
@endsection
@section('contend_head')

    <a href="{{route('employer')}}"  target="_blank">
    <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(/../../assets/img/employer.jpeg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask  "></span>
        <!-- Header container -->
    </div>
    </a>
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

        function gopay(order) {
            $.ajax({
                type: 'POST',
                url: '{{route('employer.goPay')}}',
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
    </script>
@endsection