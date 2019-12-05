@extends('admin.layout.index')
@section('css')
    <link href="{{asset('assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/build/toastr.css') }}">
    <link rel="stylesheet" href="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')}}">
    {!! we_css() !!}
    {!! we_js() !!}
    <style>

        ul,li{
            list-style: none;
            padding:0;
            margin:0;
        }

    </style>

@endsection
@section('contend_head')
    <div class="header bg-yandu pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">

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
                        <h3 class="mb-0">评价</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body col-md-8 center">
                        <form id="evaluate_form">
                            <div class="form-group">
                                <div class="order-evaluation clearfix">
                                    <h4>项目发布者：{{$merModel->company}}</h4>
                                    <p>请对《{{$proModel->project_name}}》项目进行评价</p>
                                    <div class="block">
                                        <ul>
                                            <li data-default-index="0">
                                            <span>
                                                <img src="{{asset('assets/img/x1.png')}}">
                                                <img src="{{asset('assets/img/x1.png')}}">
                                                <img src="{{asset('assets/img/x1.png')}}">
                                                <img src="{{asset('assets/img/x1.png')}}">
                                                <img src="{{asset('assets/img/x1.png')}}">
                                            </span>
                                                <em class="level"></em>
                                            </li>
                                        </ul>
                                    </div>

                                        {!! we_field('wangeditor', 'content') !!}
                                        {!! we_config('wangeditor') !!}
                                </div>
                            </div>
                            <input type="hidden" name="start" id="start" value="">
                            <input type="hidden" name="tag" id="tag" value="">
                            <input type="hidden" name="project"  value="{{$proModel->id}}">
                            <input type="hidden" name="project_side"  value="{{$proModel->merchant_id}}">
                        </form>
                        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="submit()">提交</button>
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
    <script type="text/javascript">
        /*
         * 根据index获取 str
         * **/
        function byIndexLeve(index){
            var str ="";
            switch (index) {
                case 0:
                    str="差评";
                    break;
                case 1:
                    str="较差";
                    break;
                case 2:
                    str="中等";
                    break;
                case 3:
                    str="一般";
                    break;
                case 4:
                    str="好评";
                    break;
            }
            return str;
        }
        //  星星数量
        var stars = [
            ['x2.png', 'x1.png', 'x1.png', 'x1.png', 'x1.png'],
            ['x2.png', 'x2.png', 'x1.png', 'x1.png', 'x1.png'],
            ['x2.png', 'x2.png', 'x2.png', 'x1.png', 'x1.png'],
            ['x2.png', 'x2.png', 'x2.png', 'x2.png', 'x1.png'],
            ['x2.png', 'x2.png', 'x2.png', 'x2.png', 'x2.png'],
        ];
        $(".block li").find("img").hover(function(e) {
            var obj = $(this);
            var index = obj.index();
            if(index < (parseInt($(".block li").attr("data-default-index")) -1)){
                return ;
            }
            var li = obj.closest("li");
            var star_area_index = li.index();
            for (var i = 0; i < 5; i++) {
                li.find("img").eq(i).attr("src","{{asset('assets/')}}"+ "/img/" + stars[index][i]);//切换每个星星
            }
            $(".level").html(byIndexLeve(index));
        }, function() {
        })


        $(".block li").find("img").click(function() {
            var obj = $(this);
            var li = obj.closest("li");
            var star_area_index = li.index();
            var index1 = obj.index();
            li.attr("data-default-index", (parseInt(index1)+1));
            var index = $(".block li").attr("data-default-index");//点击后的索引
            index = parseInt(index);
            console.log("index",index);
            $("#start").attr("value",index);
            $(".level").html(byIndexLeve(index-1));
            $("#tag").attr("value",byIndexLeve(index-1));
            console.log(byIndexLeve(index-1));
            $(".order-evaluation ul li:eq(0)").find("img").attr("src","{{asset('assets/img/x1.png')}}");
            for (var i=0;i<index;i++){
                $(".order-evaluation ul li:eq(0)").find("img").eq(i).attr("src","{{asset('assets/img/x2.png')}}");
            }
        });
        //印象

    </script>



    <script>
        function submit(){

            var formData = new FormData($('#evaluate_form')[0]);

            $.ajax({
                type: 'POST',
                url: '/admin/evaluate/merchant/project_side',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
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
                        timer: 2000
                    })
                    setTimeout(function(){
                        location.href = '{{url('admin/demand/partner/index')}}';
                    },2000);

                }
            })

        }
    </script>

@endsection