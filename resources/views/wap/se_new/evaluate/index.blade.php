@extends('wap.se_new.layout.base')
@section('wap_css')
    <style>
        .user-top{
            width: 100%;
            /*background:url(../../images/user_bg.png) no-repeat center; */
            background-color: #a90909;
            background-size: cover;
            position: relative;
        }
        .rounded-bottom{
            border-bottom-right-radius: 1.675rem !important;
            border-bottom-left-radius: 1.675rem !important;
        }
        .card-profile-image img {
            border: 0px solid #fff;
        }
        .card-body {
            padding: 1.6rem 1rem .6rem 1rem;
            flex: 1 1 auto;
        }
        ul{
            /*width: 400px;*/
            display: flex;
            flex-wrap: wrap;
            /*border:1px solid #eee;*/
            /*padding: 10px;*/
        }
        ul li{
            list-style-type: none;
            min-width: 50px;
            height: 20px;
            margin-right: 10px;
            margin-bottom: 10px;
            padding: 0px 3px;
            color:rgb(183,184,186);
            background: rgb(236,240,245);
            float: left;
            text-align: center;
            line-height: 20px;
            font-size: 10px;
            cursor: pointer;
            border-radius: 3px;
        }
        .select{
            font-weight:bold;
            background: rgb(51,137,240);
            color:#fff;
        }
        .form-group{
            margin-bottom: .3rem;
        }

    </style>

@endsection
@section('content')
    <div class="card rounded-bottom " style="box-shadow: 0 .525rem 0.35rem rgba(0, 0, 0, 0.215) !important;">
        <div class="card-body rounded-bottom" style="background-color: #a90909">
            <div class="row justify-content-center mt-2 mb-1 ">
                <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                        <img src="{{asset('wap/images/member.png')}}" class="rounded-circle w-25" >
                    </div>
                </div>
            </div>
            <div class=" text-center border-0 pt-2 pt-md-4 pb-0 pb-md-4">

            </div>
            <div class="text-center">
                <div class="text-white text-xx ">司马懿</div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <span class="text-xxs">您对此次服务是否满意？请点亮笑脸进行评价哦！</span>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-wrapper">
                    <!-- Form controls -->
                    <div class="card" style="background-color: #fff0;box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);">
                        <!-- Card header -->
                        <!-- Card body -->
                        <div class="card-body" style="padding: .6rem .2rem .6rem .2rem;">
                            <form id="evaluate_form">
                                <div class="form-group">
                                    <div class='score'>
                                        <div class='score-expression'> </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="" id="tag_title"  name="version">

                                    </div>
                                </div>

                                <div class="form-group">
                                    {{--<label class="" >评价详情</label>--}}
                                    {{--<textarea class="cell-textarea" placeholder="请对改施工人员进行评价" name="content" style="height: 3rem;"  ></textarea>--}}
                                    <textarea class="cell-textarea" name="content" maxlength="200" placeholder="请对改施工人员进行评价" onchange="this.value=this.value.substring(0,200)"  onkeydown="this.value=this.value.substring(0,200)" onkeyup="this.value=this.value.substring(0,200)"></textarea>
                                    <span class="float-right t_h"><i>0</i>/200</span>
                                </div>
                                <input type="hidden" name="openid" value="{{$data['openid']}}">
                                <input type="hidden" name="nickname" value="{{$data['nickname']}}">
                                <input type="hidden" name="avatar" value="{{$data['avatar']}}">
                                <input type="hidden" name="worker_id" value="{{$data['worker_id']}}">
                            </form>
                            <div class="mt-2">
                                <button type="submit" class="btn-block btn-danger" id="sub"  style="border-radius: .5rem;">评价</button>

                            </div>
                        </div>
                    </div>
                    <!-- HTML5 inputs -->
                </div>
            </div>
        </div>
        <!-- Footer -->
    </div>
<div class="container">

</div>


@endsection

@section('wap_js')

    <script src="{{asset('wap/se_new/js/score.js')}}"></script>
    <script>
        $('.score').score();
    </script>
    <script type="text/javascript">
        !function (win, $) {
            var dialog = win.YDUI.dialog;
            $("body").delegate("#test li","click", function(){
                let text = $(this).text();
                console.log(text)
                if ($(this).hasClass('select')) {
                    $(this).removeClass("select")
                    $(this).children('input').remove()
                }else {
                    $(this).addClass('select')
                    $(this).append("<input type='hidden' name='tag[]' value='"+text+"'>")
                }
            });

            $('#sub').click(function() {
                let _form_ = true ,
                    scoreArr = [] ,
                    eachEle = $('.score').children('[class^="score-"]');
                    eachEle.each(function(index, el) {
                        let l = $(el).children().attr('active-level');
                        if(!l) _form_ = false;
                        scoreArr.push(l);
                    });
                let count = scoreArr.reduce(function(p,c){ return p + parseInt(c); },0)
                let formData = new FormData($('#evaluate_form')[0]);
                formData.append('start',count)
                $.ajax({
                    type: 'POST',
                    url: '/m/se_new/worker/evaluate/create',
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
                            window.location.href = "{{ url('m/se_new/worker/evaluate/').$data['worker_id'] }}";
                        },1000);
                    }
                })
            })
        }(window, jQuery);
    </script>
    <script>
        $(".cell-textarea").focus(function(){
            if($(this).val()==""){
                $(".tcp_box p").css('display','none')
            }

        }).blur(function(){
            if($(this).val()==""){
                $(".tcp_box p").css('display','block')
            }else{
                $(".tcp_box p").css('display','none')
            }

        })
        $(".pl_tcp").click(function(){　　　　　　　　
            $(this).css('display','none');　　　　　　　　
            $(".cell-textarea").focus();　　　　
        })
        $(".cell-textarea").change(function(){
            $(".t_h i").html($(".cell-textarea").val().length)
        })
        $(".cell-textarea").keydown(function(){
            $(".t_h i").html($(".cell-textarea").val().length)
        })
        $(".cell-textarea").keyup(function(){
            $(".t_h i").html($(".cell-textarea").val().length)
        })
    </script>
@endsection