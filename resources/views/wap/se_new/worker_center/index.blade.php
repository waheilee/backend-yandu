@extends('wap.se_new.layout.base')
@section('wap_css')
    <link href="{{asset('wap/se_new/css/user.css')}}" rel="stylesheet">
    <link href="{{asset('wap/se_new/js/cropper/cropper.min.css')}}" rel="stylesheet">
    <link href="{{asset('wap/se_new/js/sitelogo/sitelogo.css')}}" rel="stylesheet">

@endsection
@section('content')
    <div class="user-top">
        <div class="header user-header">
            @if(empty($member))
                <div class="header-setting">
                    <a href="{{url('m/se_new/worker/edit/'.Auth::id())}}"></a>
                </div>
            @else
                <div class="header-evaluate">
                    <a href="{{url('m/se_new/worker/evaluate').'/'.$worker->id}}" class="btn btn-hollow">评论</a>
                </div>
            @endif
        </div>

        <div class="user-info ">
            <div class="container-fluid">
                <div class="card-body" style="padding: .1rem">
                    <div class="row row-example">
                        <div id="crop-avatar" >
                            <div class="avatar-view" title="Change Logo Picture">
                                <img src=" @if(!$worker->avatar) {{asset('wap/images/member.png')}} @else {{getAliOssUrl().$worker->avatar}} @endif" class="rounded float-left " style="width: 100px;" >
                            </div>
                        </div>
                        <div class="col">
                            <div class="media position-relative">
                                {{--<img src="{{asset('wap/images/member.png')}}" class="rounded float-left w-25" >--}}
                                <div class="media-body ml-1">
                                    <div class="text-white text-xx ">姓名：{{$worker->name}}</div>
                                    <div class="text-white text-xx ">年龄：{{$worker->age}}</div>
                                    <div class="text-white text-xx ">电话：{{$worker->phone}}</div>
                                    <div class="text-white text-xx ">职业：{{$worker->tec}}</div>
                                </div>
                            </div>
                        </div>
                        {{--<div class="w-100"></div>--}}
                        {{--<div class="col"><span>col</span></div>--}}
                        {{--<div class="col"><span>col</span></div>--}}
                    </div>
                </div>

            </div>
            <div   class="text text-sm  text-white ">
                <p style="font-size: 15px" class="mb-1">险种：雇主责任险  </p>
                <p style="font-size: 15px" class="mb-1">有效期：{{$policyTime}}</p>
            </div>
            <div class="user-wallet shadow-lg p-0 bg-white rounded">
                <ul>
                    <li>
                         <p class="text-xx"><span>好评率:</span>{{$point}}%</p>
                    </li>

                    <li>
                        <p class="text-xx"><span>评价数:</span>{{$count}}</p>
                    </li>

                </ul>
            </div>

        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-xl-4 order-xl-2">
                @foreach($evaluate as $eva)
                <div class="card card-profile shadow-lg  bg-white rounded">

                    <div class=" text-center border-0 pt-1 pb-0 pl-1 pr-1">
                        <div class="media position-relative">
                            <img style="width: 15%" class="rounded-circle float-left" src="@if(!$eva->wechat_avatar) ../../../wap/images/member.png @else {{$eva->wechat_avatar}} @endif">
                            <div class="row ml-1">
                                <div class="mb-1" >
                                    <span class="float-left" style="font-size: 25%;">@if(!$eva->wechat_nickname)匿名@else{{$eva->wechat_nickname}}@endif</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="goods-comment-level mt-2 ml-1" style="height: .3rem">
                                    @for($i = 1 ; $i <= $eva->start ;$i++ )
                                        <i class="active" id="{{$eva[$i]}}"></i>
                                    @endfor
                                    {{--<i class="active" id=""></i>--}}
                                    {{--<i class="active" id=""></i>--}}
                                    {{--<i class="active" id=""></i>--}}
                                    {{--<i class="active" id=""></i>--}}
                                    {{--<i class="active" id=""></i>--}}
                                </div>
                            </div>

                        </div>
                        <div class="float-right " style="position: absolute;left: 4.7rem;top: .78rem; font-size: 25%;">{{$eva->created_at}}</div>
                    </div>
                    <div class="card-body pt-1 pr-1 pl-1 pb-1">
                        <div class="row">
                            <div class="col">
                                <p class=" heading mb-0 text-xxs">
                                    {{$eva->content}}
                                </p>
                            </div>

                        </div>

                    </div>
                </div>
                @endforeach
                <!-- Progress track -->
            </div>
        </div>

    </div>
    <div class="ajax-load load-more text-center" style="display:none">
        <a>加载更多……</a>
    </div>
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-xl" style="margin: .1rem;">
            <div class="modal-content">
                <form class="avatar-form"  enctype="multipart/form-data" method="post" id="avatar">
                    <div class="modal-header" style="padding: .3rem;">
                        <button class="close float-left" data-dismiss="modal" type="button" style="padding: .1rem;margin: 0rem 0rem 0rem 0rem; font-size: .5rem">&times;</button>
                        <p class="text-xx float-right" id="avatar-modal-label">更换头像</p>
                    </div>
                    <div class="modal-body" style="padding: .1rem;">
                        <div class="avatar-body">
                            <div class="avatar-upload">
                                <input class="avatar-src" name="avatar_src" type="hidden">
                                <input class="avatar-data" name="avatar_data" type="hidden">
                                <label for="avatarInput">图片上传</label>
                                <input class="avatar-input" id="avatarInput" name="avatar_file" type="file" accept="image/*" multiple></div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="avatar-wrapper"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="avatar-preview preview-lg"></div>
                                    <div class="avatar-preview preview-md"></div>
                                    <div class="avatar-preview preview-sm"></div>
                                </div>
                            </div>
                            <div class="row avatar-btns">
                                <div class="col-md-9">
                                    <div class="btn-group">
                                        <button class="btn" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees"><i class="fa fa-undo"></i> 向左旋转</button>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees"><i class="fa fa-repeat"></i> 向右旋转</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-md-3 mb-3">
                    <button class="btn btn-success btn-block avatar-save"  id="avatar_update"><i class="fa fa-save"></i> 保存修改</button>
                </div>
            </div>
        </div>
    </div>

    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
@endsection

@section('wap_js')
    <script src="{{asset('wap/se_new/js/cropper/cropper.min.js')}}"></script>
    <script src="{{asset('wap/se_new/js/sitelogo/sitelogo.js')}}"></script>
    <script type="text/javascript">
        var page = 1;
        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() + 1>= $(document).height()) {
                page++;
                loadMoreData(page);
            }
        });

        function loadMoreData(page){
            $.ajax({
                url: '',
                type: "get",
                beforeSend: function()
                {
                    $('.ajax-load').show();
                }
            })
                .done(function(data)
                {
                    //console.log(data.html);
                    if(data.html == ""){
                        $('.ajax-load').html("<a>没有数据了……</a>");
                        return;
                    }
                    $('.ajax-load').hide();
                    $("#post-data").append(data.html);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                    alert('服务未响应……');
                });
        }
        !function (win, $){
            var dialog = win.YDUI.dialog;

            $('#avatar_update').on('click', function () {

                //提交表单
                let formData = new FormData($('#avatar')[0]);
                $.ajax({
                    type: 'POST',
                    url: '/m/se_new/worker/avatar/edit',
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    },
                    success : function (data) {
                        dialog.toast(data, 'success', 1500);
                        setTimeout(function(){
                            window.location.reload();
                        },1500);
                    }
                })
            })
        }(window, jQuery);
    </script>
    @endsection