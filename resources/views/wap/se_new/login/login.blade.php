@extends('wap.se_new.layout.base')
@section('wap_css')
    <style>
    </style>
@endsection
@section('content')
    {{--<img src="" style="width: 100%">--}}

<div class="se_new_login">
    <div class="container-fluid pr-0 pl-0 ">
        {{--<img src="{{asset('wap/se_new/image/login/login.png')}}" class="img-fluid" alt="Image placeholder">--}}
        <div class="header mt-3 mb-3" >
            <img src="{{asset('wap/images/member.png')}}" class="mx-auto d-block" style="width: 20%;border-radius: 1.3rem">
        </div>
    </div>

</div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4 ">
                <form action="" id="login_form">
                    <div class="cell-item">
                        <div class="cell-left mr-1"><i class="cell-icon ni ni-mobile-button"></i></div>
                        <div class="cell-right">
                            <input type="number" pattern="[0-9]*" class="cell-input" name="phone" placeholder="请输入手机号码" autocomplete="off">
                        </div>
                    </div>
                    <div class="cell-item">
                        <div class="cell-left mr-1"><i class="cell-icon ni ni-lock-circle-open"></i></div>
                        <div class="cell-right">
                            <input type="password"  class="cell-input" name="password" placeholder="输入密码（默认手机号码后六位）" autocomplete="off">
                        </div>
                    </div>
                    <div class="cell-item"></div>
                </form>
                <div class="mt-4">
                    <button type="submit" class="btn-block btn-danger" onclick="login_submit()"  style="border-radius: .5rem;">登录</button>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('wap_js')
    <script>
        function login_submit () {
            var form = new FormData($('#login_form')[0]);
            var url = "{{ url('m/se_new/login') }}";
            $.ajax({
                type: 'post',
                url: url,
                data: form,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    window.location.href = "{{ url('m/se_new/worker_center') }}";
                },
                error:function (data) {
                    var json = JSON.parse(data.responseText);
                    $.each(json.errors, function(idx, obj) {
                        toastr.warning(obj[0]);
                        // alert(obj[0]);
                        return false;
                    });

                }
            })
        };
    </script>

    @endsection