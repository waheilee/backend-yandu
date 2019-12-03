@extends('admin.layout.index')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')}}">
    {!! we_css() !!}
    {!! we_js() !!}
@endsection
@section('contend_head')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">个人中心</h6>
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

                <div class="card-body">
                    <div class="card card-profile col-md-10 center">
                        <div class="card-header">
                            <h3 class="mb-0">商家信息</h3>
                        </div>
                        <img src="{{asset('assets/img/banner1.jpg')}}" alt="Image placeholder" class="card-img-top" style="height: 200px">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <a href="#">
                                        <img src="{{getAliOssUrl().$user->logo}}" class="rounded-circle">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                            <div class="d-flex justify-content-between">

                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col">
                                    <div class="card-profile-stats d-flex justify-content-center">

                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3 class="h1">
                                    {{$user->company}}
                                </h3>
                                <div class="h3 font-weight-300 mr-9 ml-9">
                                    <i class="ni location_pin mr-2"></i>{{$user->intro}}
                                </div>
                            </div>
                            <ul class="list-unstyled my-4 mr-9 ml-9 ">
                                <li>
                                    <div class="d-flex align-items-center my-2">
                                        <div>
                                            <div class="icon icon-xs icon-shape bg-gradient-success text-white shadow rounded-circle">
                                                <i class="ni ni-pin-3"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="pl-2 text-lg font-weight-300">{{$user->address}}</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center my-2">
                                        <div>
                                            <div class="icon icon-xs icon-shape bg-gradient-primary text-white shadow rounded-circle">
                                                <i class="ni ni-mobile-button"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="pl-2 text-lg font-weight-300">联系方式： 4008-010-911</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card card-profile col-md-10 center">
                        <!-- Card header -->
                        <div class="card-header">
                            <h3 class="mb-0">公司介绍</h3>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <form id="merchant">
                                {!! we_field('wangeditor', 'content',$user->introduction) !!}
                                {!! we_config('wangeditor') !!}
                            </form>
                            <div class="fa-pull-right col-md-4 m-3">
                                <button type="button" onclick="submit()" class="btn btn-primary btn-lg btn-block">保存</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    <script>
        function submit(){

            var formData = new FormData($('#merchant')[0]);

            $.ajax({
                type: 'POST',
                url: '{{route('merchant.edit_intro')}}',
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
                        showConfirmButton:false,
                        timer: 1500
                    })
                    setTimeout(function(){
                        window.location.reload();
                    },1500);

                }
            })

        }
    </script>
@endsection