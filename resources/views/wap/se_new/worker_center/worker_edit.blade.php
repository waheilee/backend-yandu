@extends('wap.se_new.layout.base')
@section('wap_css')
    <link href="{{asset('wap/se_new/css/user.css')}}" rel="stylesheet">
    <style>
        /*textarea,select,input[type="text"],input[type="button"], input[type="submit"], input[type="reset"] {*/
            /*-webkit-appearance: none;*/
            /*appearance:none;*/
            /*outline:none;*/
            /*-webkit-tap-highlight-color:rgba(0,0,0,0);*/
            /*border-radius:0;*/
            /*background: none;*/
        /*}*/

        .info_list{
            width:100%;
            height:50px;
            border-bottom:1px solid #F2F2F2;
        }

        .list_left2{
            width:97%;
            margin-left:3%;
            height:50px;
            font-family:"微软雅黑";
            font-size:16px;
            color:#636363;
            line-height:50px;
            float:left;
        }
        .list_left2 span{
            color:#A04E52;
            font-size:12px;
            margin-left:5px;
        }

        .id_img_wp{

            width:94%;
            margin:0 auto;
            min-height:30px;
        }
        .img_wp{
            width:40%;
            margin:0 5% 0 5%;
            float:left;
            cursor:pointer;
        }
        .img_wp img{
            width:100%;
            height:100%;
        }
        .img_intro{
            color:#383838;
            text-align:center;
            font-family:"微软雅黑";
            padding:10px 0 10px 0;
        }
        .cf{
            clear:both;
        }
        </style>
@endsection
@section('content')
    <header class="m-navbar">
        <a href="javascript:history.go(-1);" class="navbar-item"><i class="back-ico"></i></a>
        <div class="navbar-center"><span class="navbar-title">修改个人资料</span></div>
    </header>

    <form action="" id="worker">
        <div class="m-cell demo-small-pitch">
            <div class="info_list" style="border-bottom:none;">
                <div class="list_left2">身份证上传<span>(请上传身份证正反面，图片保持清晰)</span></div>
            </div>
            <div class="id_img_wp">
                <input type="file" accept="image/*" onchange="getzImg(this)" value="" id="img_z" style="display:none" name="id_card_a"/>
                <input type="file" accept="image/*" onchange="getfImg(this)" value="" id="img_f" style="display:none" name="id_card_b"/>

                <div class="img_wp" onclick="zhengmian()">
                    <img src="@if($workerModel->card_a == '-'){{asset('wap/se_new/image/idcard1.png')}} @else {{getAliOssUrl().$workerModel->card_a}} @endif" id="zmz" class="rounded"/>
                    <span class="img_intro">身份证正面照</span>
                </div>

                <div class="img_wp" onclick="fanmian()">
                    <img src="@if($workerModel->card_b == '-'){{asset('wap/se_new/image/idcard2.png')}} @else {{getAliOssUrl().$workerModel->card_b}} @endif" id="fmz" class="rounded"/>
                    <span class="img_intro">身份证反面照</span>
                </div>
                <div class="cf"></div>
            </div>
            <div class="cell-item">
                <div class="cell-left">身份证号码：</div>
                <div class="cell-right">
                    <input type="text" class="cell-input" placeholder="身份证号码" autocomplete="off" name="id_card" id="id_card" value="{{$workerModel->card_num}}">
                </div>
            </div>
            <div class="cell-item">
                <div class="cell-left">姓名：</div>
                <div class="cell-right">
                    <input type="text" class="cell-input" placeholder="姓名" autocomplete="off" name="name" id="name" value="{{$workerModel->name}}">
                </div>
            </div>
            <div class="cell-item">
                <div class="cell-left">性别：</div>
                <div class="cell-right ">
                    <select class="cell-input" name="sex">
                        <option value="">请选择性别</option>
                        <option value="1" @if($workerModel->sex == 1) selected="selected" @endif>男</option>
                        <option value="2" @if($workerModel->sex == 2) selected="selected" @endif>女</option>
                    </select>
                </div>
            </div>
            <div class="cell-item">
                <div class="cell-left">手机：</div>
                <div class="cell-right">
                    <input type="text" class="cell-input" placeholder="手机" autocomplete="off" name="phone" id="phone" value="{{$workerModel->phone}}">
                </div>
            </div>
            <div class="cell-item">
                <div class="cell-left">年龄：</div>
                <div class="cell-right">
                    <input type="text" class="cell-input" placeholder="年龄" autocomplete="off" name="age" id="age" value="{{$workerModel->age}}">
                </div>
            </div>
            <div class="cell-item">
                <div class="cell-left">职业：</div>
                <div class="cell-right">
                    {{--<input type="text" class="cell-input" placeholder="职业" autocomplete="off" name="occupation" id="occupation">--}}
                    <select class="cell-input" name="occupation">
                        <option value="">请选择职业</option>
                        <option value="1" @if($workerModel->tec == 1) selected="selected" @endif>贴瓷砖</option>
                        <option value="2" @if($workerModel->tec == 2) selected="selected" @endif>除甲醛</option>
                        <option value="3" @if($workerModel->tec == 3) selected="selected" @endif>保洁</option>
                        <option value="4" @if($workerModel->tec == 4) selected="selected" @endif>瓦工</option>
                        <option value="5" @if($workerModel->tec == 5) selected="selected" @endif>油工</option>
                        <option value="6" @if($workerModel->tec == 6) selected="selected" @endif>水暖工</option>
                    </select>
                </div>
            </div>
            <div class="cell-item">
                <div class="cell-left">工作年限：</div>
                <div class="cell-right">
                    <input type="text" class="cell-input" placeholder="工作年限" autocomplete="off" name="working_life" id="working_life" value="{{$workerModel->work_age}}">
                </div>
            </div>

        </div>
        <div class="m-celltitle">其他工作技能</div>
        <div class="m-cell">
            <div class="cell-item">
                <div class="cell-right">
                    <textarea class="cell-textarea" name="content" placeholder="请输入您的银行卡卡号和密码">{!! $workerModel->tec_text !!}</textarea>
                </div>
            </div>
        </div>
        <input type="hidden" name="id" value="{{$workerModel->id}}">
    </form>

    <div class="mt-1">
        <button type="submit" class="btn-block btn-danger" id="worker_update" style="border-radius: .5rem;">提交修改</button>

    </div>

@endsection

@section('wap_js')

    <script>
        $(function(){
            $('.img_wp img').height($('.img_wp img').width()*0.6);
            $(window).resize(function(){
                $('.img_wp img').height($('.img_wp img').width()*0.6);
            })
        })
        //正面
        function zhengmian(){
            $('#img_z').click();
            console.log($('#img_z').click())
        }
        function getzImg(imgFile){

            var file = imgFile.files[0];

            var reader = new FileReader();
            reader.readAsDataURL(file);//将文件读取为Data URL小文件   这里的小文件通常是指图像与 html 等格式的文件
            reader.onload = function(e){
                $("#zmz").attr("src",e.target.result);
            }
        }

        //反面
        function fanmian(){
            $('#img_f').click();
            console.log($('#img_f').click())
        }
        function getfImg(imgFile){

            var file = imgFile.files[0];

            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function(e){
                $("#fmz").attr("src",e.target.result);
            }
        }

        //申请
        !function (win, $){
            var dialog = win.YDUI.dialog;

            $('#worker_update').on('click', function () {
                if($('#name').val().length<1){
                    $('#name').focus();
                    dialog.toast('请输入姓名', 'none', 1500);
                    return false;
                }

                var cardNo=$('#id_card');
                if(cardNo.val() &&  /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/.test(cardNo.val())){

                }else{
                    cardNo.focus();
                    dialog.toast('身份证号码格式不正确', 'none', 1500);
                    return false;
                }
                var call_no = $('#phone');
                if(call_no.val() && /^1[3|4|5|7|8]\d{9}$/.test(call_no.val())){

                } else{
                    call_no.focus();
                    dialog.toast('手机号码格式不正确', 'none', 1500);
                    return false;
                }
                // if($('#img_z').val()==null||$('#img_z').val()==''){
                //     dialog.toast('请上传身份证正面照', 'none', 1500);
                //     return false;
                // }
                // if($('#img_f').val()==null||$('#img_f').val()==''){
                //     dialog.toast('请上传身份证反面照', 'none', 1500);
                //     return false;
                // }

                //提交表单
                    let formData = new FormData($('#worker')[0]);
                    $.ajax({
                        type: 'POST',
                        url: '/m/se_new/worker/update',
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
                                window.location.href = "{{ url('m/se_new/worker_center') }}";
                            },1500);

                        },
                        error : function (data) {
                            let json = JSON.parse(data.responseText);
                            $.each(json.errors, function(idx, obj) {
                                dialog.toast(obj[0], 'none', 2500);
                                return false;
                            });
                        }
                    })
            })
        }(window, jQuery);
    </script>
@endsection