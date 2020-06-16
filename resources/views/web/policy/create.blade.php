@extends('web.layout.app')
@section('web_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/build/toastr.css') }}">

@endsection
@section('detail')

    <!-- Modal -->
    <div class="card-body">
        <form role="form" id="policy">
            <input type="hidden" name="policy_id" value="{{$row->id}}">
            <input type="hidden" name="merchant_id" value="{{$row->merchant_id}}">
            {{--<div class="form-group">--}}
                {{--<label class="form-control-label" for="">邀请识别码<span class="text-danger">*</span></label>--}}
                {{--<input class="form-control " placeholder="邀请识别码" name="code" type="text">--}}
            {{--</div>--}}
            <div class="form-group">
                <label class="form-control-label" for="">职员姓名<span class="text-danger">*</span></label>
                <input class="form-control" placeholder="职员姓名" name="username" type="text">
            </div>
            <div class="form-group">
                <label class="form-control-label" for="">身份证号<span class="text-danger">*</span></label>
                <input class="form-control" placeholder="身份证号" name="idcard" type="text">
            </div>
            <div class="form-group">
                <label class="form-control-label" for="">手机号码<span class="text-danger">*</span></label>
                <input class="form-control" placeholder="手机号码" name="phone" type="text">
            </div>
            <div class="form-group">
                <label class="form-control-label" for="">邮箱<span class="text-danger">*</span></label>
                <input class="form-control" placeholder="邮箱" name="email" type="email">
            </div>
            <div class="form-group">
                <label class="form-control-label" for="">职位<span class="text-danger">*</span></label>
                <input class="form-control" placeholder="职位" name="position" type="text">
            </div>

            <div class="form-group">
                <label class="form-control-label" for="">薪资范围<span class="text-danger">*</span></label>
                <select class="form-control" name="payroll" id="">
                    <option>低于7k</option>
                    <option>7k-10k</option>
                    <option>10k-20k</option>
                    <option>20k以上</option>
                </select>
            </div>

        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-danger" onclick="submit()">提交</button>
    </div>

@endsection

@section('web_js')
    <script src="{{asset('assets/vendor/toastr/build/toastr.min.js') }}"></script>

    <script>
        function submit() {
            var formData = new FormData($('#policy')[0]);
            $.ajax({
                type: 'POST',
                url: '{{route('policy.store')}}',
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
                        confirmButtonText:'确定'
                        // timer: 2000
                    })
                    setTimeout(function(){
                        location.reload()
                    },2000);
                },
                error : function (data) {
                    var json = JSON.parse(data.responseText);

                    $.each(json.errors, function(idx, obj) {
                        toastr.warning(obj[0]);
                        return false;
                    });
                    // var json = JSON.parse(data.responseText);
                    // toastr.warning(json.message);
                    // return false;
                }
            })
        }
    </script>
@endsection