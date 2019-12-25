@extends('web.layout.app')
@section('web_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/build/toastr.css') }}">
@endsection
@section('detail')
    <div class="container ptb50 mt-5">
        <div class="card card-pricing border-0 text-center mb-4">
            <div class="card-header bg-transparent">
                <h4 class="text-uppercase ls-1 text-primary py-3 mb-0">购买保单</h4>
            </div>
            <div class="card-body px-lg-7">
                <div class="display-2">￥{{exchangeToYuan($orderModel->total_amount) }}</div>
                {{--<span class="text-muted">per application</span>--}}
                <div class="row mt-3 mb-3">

                </div>
                <button type="button" class="btn btn-success mb-3" onclick="wechat()">微信购买</button>

                <a href="{{url('/alipay/'.$orderModel->id)}}" type="button" class="btn btn-primary mb-3">支付宝购买</a>
            </div>
            <div class="card-footer">

            </div>
        </div>

    </div>
    <!-- Modal -->
    <input type="hidden" name="order_id" id="order_id" value="{{$orderModel->id}}" >
@endsection

@section('web_js')
    <script src="{{asset('assets/vendor/toastr/build/toastr.min.js') }}"></script>
    <script>
        var order = $('input[name=order_id]').val()

        function wechat(){
            var url = "{{ route('employer.wechatPay') }}";
            $.ajax({
                type: 'post',
                url: url,
                data: {'order_id':order},
                // cache: false,
                // processData: false,
                // contentType: false,
                dataType: 'json',
                headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content')},
                success: function(data){
                    Swal.fire({
                        title: '<strong>微信扫码支付</strong>',
                        icon: 'info',
                        html:
                        '<img src="data:image/png;base64,'+data.qrcode+'"> ' ,
                        showCloseButton: false,
                        showCancelButton: false,
                        showConfirmButton:false,
                        focusConfirm: false,
                    })
                    orders = data
                    function cprint() {
                        return orders;
                    }
                    window.setInterval(function(){
                        // console.log(cprint())
                        var data = cprint()
                        $.ajax({
                            type: 'post',
                            url:"{{route('notify')}}",
                            data: {'order':data.out_trade_no},
                            dataType:'json',
                            headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content')},
                            success:function(data) {
                                Swal.fire({
                                    title: '提示',
                                    text:''+data.message+'',
                                    type: 'success',
                                    focusConfirm: false, //聚焦到确定按钮
                                    showCloseButton: true,//右上角关闭
                                    showConfirmButton:false,
                                    timer:2000
                                });
                                setTimeout(function() {
                                    window.location.href='{{url('admin/policies/employer/index')}}'
                                },2000);
                            }
                        })},3000);
                },
                error:function (data) {
                    var json = JSON.parse(data.responseText);
                    Swal.fire({
                        title: '未满足项目需求',
                        text: json.message,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        showConfirmButton:false,
                        cancelButtonText:'取消'
                    });
                    // toastr.warning(json.message,'修改失败');
                    return false;
                    // alert(data.message)
                }


            });
        }
    </script>
@endsection