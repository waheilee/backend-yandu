@extends('wap.se_new.layout.base')
@section('wap_css')
    <style>
        .se_new_login{ width: 100%; min-height: 30%; background:url(../../../wap/se_new/image/login/login.png) no-repeat; background-size:100% 100%;position: relative;}
    </style>
@endsection
@section('content')

    <div class="se_new_login">
        <div class="container-fluid pr-0 pl-0 ">
            <div class="header mt-3 mb-3" >
                <img src="{{asset('wap/images/member.png')}}" class="mx-auto d-block" style="width: 20%;border-radius: 1.3rem">
            </div>
        </div>

    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-7 mt-4">
                <form action="" id="register">
                    <div class="cell-item">
                        <div class="cell-left mr-1"><i class="cell-icon ni ni-single-02"></i></div>
                        <div class="cell-right">
                            <input type="text"  class="cell-input" name="name" placeholder="姓名" autocomplete="off">
                        </div>
                    </div>
                    <div class="cell-item">
                        <div class="cell-left mr-1"><i class="cell-icon ni ni-mobile-button"></i></div>
                        <div class="cell-right">
                            <input type="number" pattern="[0-9]*"  class="cell-input" name="phone" id="phone" placeholder="手机号" autocomplete="off">
                        </div>
                    </div>
                    {{--<div class="cell-item">--}}
                        {{--<div class="cell-left mr-1"><i class="cell-icon ni ni-lock-circle-open"></i></div>--}}
                        {{--<div class="cell-right">--}}
                            {{--<input type="password" pattern=""  class="cell-input" name="password" placeholder="密码默认手机号码后六位" autocomplete="off" >--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="cell-item">
                        <div class="cell-left mr-1"><i class="cell-icon ni ni-badge"></i></div>
                        <div class="cell-right">
                            <input type="number" pattern="[0-9]*"  class="cell-input" name="id_card" id="id_card" placeholder="身份证号" autocomplete="off">
                        </div>
                    </div>
                    <div class="cell-item">
                        <div class="cell-left mr-1"><i class="cell-icon ni ni-square-pin"></i></div>
                        <div class="cell-right">
                            <input type="text" class="cell-input" readonly="" id="J_Address" name="address" value="" placeholder="请选择地址">
                        </div>
                    </div>
                    <div class="cell-item"></div>
                </form>
                <div class="mt-4">
                    <button type="submit" class="btn-block btn-danger" id="J_ToastN" style="border-radius: .5rem;">注册</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('wap_js')

    <script>
        /**
         * 默认调用
         */
        !function () {
            var $target = $('#J_Address');

            $target.citySelect();

            $target.on('click', function (event) {
                event.stopPropagation();
                $target.citySelect('open');
            });

            $target.on('done.ydui.cityselect', function (ret) {
                $(this).val(ret.provance + ' ' + ret.city + ' ' + ret.area);
            });
        }();
        /**
         * 设置默认值
         */
        !function (win, $) {
            var $target = $('#J_Address2');
            var dialog = win.YDUI.dialog;
            $target.citySelect({
                provance: '新疆',
                city: '乌鲁木齐市',
                area: '天山区'
            });

            $target.on('click', function (event) {
                event.stopPropagation();
                $target.citySelect('open');
            });

            $target.on('done.ydui.cityselect', function (ret) {
                $(this).val(ret.provance + ' ' + ret.city + ' ' + ret.area);
            });


            $('#J_ToastN').on('click', function () {
                // var cardNo=$('#id_card');
                // if(cardNo.val() &&  /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/.test(cardNo.val())){
                //
                // }else{
                //     cardNo.focus();
                //     dialog.toast('身份证号码格式不正确', 'none', 1500);
                //     return false;
                // }
                // var call_no = $('#phone');
                // if(call_no.val() && /^1[3|4|5|7|8]\d{9}$/.test(call_no.val())){
                //
                // } else{
                //     call_no.focus();
                //     dialog.toast('手机号码格式不正确', 'none', 1500);
                //     return false;
                // }
                let formData = new FormData($('#register')[0]);
                $.ajax({
                    type: 'POST',
                    url: '/m/se_new/register/create',
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    },
                    success : function (data) {
                        dialog.toast(data, 'success', 1000);
                        setTimeout(function(){
                            window.location.href = "{{ url('m/se_new/login') }}";
                        },1000);

                    },
                    error : function (data) {
                        let json = JSON.parse(data.responseText);
                        $.each(json.errors, function(idx, obj) {
                            dialog.toast(obj[0], 'none', 2500);
                            return false;
                        });
                    }
                })
            });
        }(window, jQuery);
    </script>
@endsection