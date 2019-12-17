@extends('web.layout.app')
@section('web_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/build/toastr.css') }}">

@endsection
@section('detail')
        <div class="card-body container mt-4 " style="background-image: url(../../assets/img/bg_policy.png);">
            <h3>{{$row->company}}</h3>
            <p class="text-default text-sm">除醛服务送保单服务</p>
            <div id="badges-component" class="tab-pane tab-example-result fade active show" role="tabpanel" aria-labelledby="badges-component-tab">
                <span class="badge badge-info float-md-right">{{$row->policy_used}}/{{$row->policy_total}}</span><br>
                <span class="badge badge-secondary float-md-right">已填写人数</span><br>
            </div>
            <div  style="position: relative;width: 100%;-webkit-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;line-height: 26px;font-size: 14px;color: #999;text-align: right;margin-top: 10px;">
                <span >除醛商：{{$row->merchant}}</span>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-3"></div>
            </div>
        </div>
        <div class="container ptb50">

        <div class="context mt-4">
            <h3 class="text-default text-center">投保须知及声明</h3>
            <p>投保须知（内容需要贵方提供）</p>
            <p>1. 投保地区</p>
            <p>本计划仅限在中国大陆有固定居住地的人士投保。</p>
            <p>2. 保单形式</p>
            <p>网上投保为您提供电子保单，根据《中华人民共和国合同法》第十一条规定，数据电文是合法的合同表现形式， 电子保单与纸质保单具有同等法律效力。您可以登录“e站到家”自助查询对电子保单的真实性进行验证。</p>
            <p>3. 如实告知</p>
            <p>（1）您应如实填写投保信息，并就我们提出的询问据实告知,否则我们有权根据《中华人民共和国保险法》第十六条的规定解除保险合同且不承担赔偿责任。</p>
            <p>（2）订立保险合同时，保险公司就保险标的或者被保险人的有关情况提出询问的，投保人应当如实告知。</p>
            <p>（3）投保人故意或者因重大过失未履行前款规定的如实告知义务，足以影响保险公司决定是否同意承保或者提高保险费率的，保险公司有权解除合同。 </p>
            <p>（4）投保人故意不履行如实告知义务的，保险公司对于合同解除前发生的保险事故，不承担赔偿责任，并不退还保险费。 </p>
            <p>（5）投保人因重大过失未履行如实告知义务，对保险事故的发生有严重影响的，保险公司对于合同解除前发生的保险事故，不承担赔偿责任，但退还保险费。</p>
            <p>4. 信息变更</p>
            <p>如果您的邮件地址、通信地址、邮编、联系电话发生变化，请登陆自助服务专区或与本公司客户服务电话95522联系，办理变更事宜。</p>
            <p>5. 续期扣款</p>
            <p>如您在购买产品时填写了续期账号，为保证合同到期后继续有效，到期我们将根据您填写的账号信息进行自动扣款。</p>
            <p>6. 偿付能力告知 </p>
            <p>我公司2017年第2季度的综合偿付能力充足率为247.82%、核心偿付能力充足率为247.82%，2017年第1季度风险综合评级（分类监管）评价结果为A类，偿付能力充足率已达到监管要求。</p>
            <p class="mt30">投保声明</p>
            <p>1. 本人已完整阅读并了解以上投保须知及投保险种的保险条款，尤其是对其中免除保险人责任的条款或约定（包括但不限于责任免除、投保人 被保险人义务、保险金申请与给付等），本人已充分理解并接受上述内容，同意以此作为订立保险合同的依据。</p>
            <p>2. 投保单中所填写的内容均属实，如有隐瞒或不实告知，你公司有权解除保险合同，对于合同解除前发生的任何事故，你公司可不承担任何责任。 </p>
            <p>3. 本人同意你公司通过手机（包括手机短信）、E-mail适时提供保险信息服务。</p>
            <p>4. 本产品仅限中国税收居民投保。非居民或既是中国税收居民又是其他税收管辖区居民无法投保</p>
            <div class="text-center">
                <div class="mb-3">
                    <input  id="customCheck1" type="checkbox">
                    <label class="label" for="customCheck1">我已认真阅读"投保须知及声明"</label>
                </div>
                <button class="btn btn-danger w160 mt20" onclick="info()">填写信息</button>
            </div>
        </div>
    </div>
        <!-- Modal -->
        <div class="modal fade" id="modal-policy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">除醛送保单服务个人信息填写</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="policy">
                            <input type="hidden" name="policy_id" value="{{$row->id}}">
                            <input type="hidden" name="merchant_id" value="{{$row->merchant_id}}">
                            <div class="form-group">
                                <label class="form-control-label" for="">邀请识别码<span class="text-danger">*</span></label>
                                <input class="form-control " placeholder="邀请识别码" name="code" type="text">
                            </div>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-danger" onclick="submit()">提交</button>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('web_js')
    <script src="{{asset('assets/vendor/toastr/build/toastr.min.js') }}"></script>

    <script>
        function info() {
            if(!$("input[type='checkbox']").prop('checked')){toastr.warning('请阅读《投保须知及声明》后勾选声明');return false;}
            $('#modal-policy').modal('show');
        }
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