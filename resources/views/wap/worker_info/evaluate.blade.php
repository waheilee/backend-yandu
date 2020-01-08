<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable = 0">

    <title>首页</title>

    <link href="{{asset('wap/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('wap/css/user.css')}}" rel="stylesheet">
    <link href="{{asset('wap/css/shop.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/argon.css?v=1.1.0')}}" type="text/css">
    <style>
        .sweetAlert {
            width: 10em;
            margin: 0 auto;
            left: 0;
            right: 0;
        }
    </style>
</head>

<body>
<header class="header">
    <div class="header-return">
        <a href="javascript:history.go(-1);"></a>
    </div>

    <div class="logo">评价</div>
</header>
        <form id="evaluate_form">

            <div class="card-wrapper">
                <div class="card">
                    <div class="card-body pt-1 pr-1 pl-1 pb-1">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <!-- Avatar -->
                                    <div  class="avatar avatar-lg ">
                                        <img alt="Image placeholder" src="{{asset('wap/images/member.png')}}" >
                                    </div>
                                </div>
                                <div class="mx-1">
                                    <div class="text-dark font-weight-300 text-sm">{{$data['worker']}}</div>
                                    <small class="d-block text-muted"></small>
                                </div>

                            </div>
                            <div class=" text-center">
                                <div class="order-evaluation clearfix">
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
                                            </li>
                                            <em class="level" style="font-size: 15px"></em>

                                        </ul>

                                    </div>

                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="textarea-group">
                <textarea placeholder="请留下你宝贵的评价" name="content" id="TextArea1" onKeyUp="words_deal();"></textarea>
                <input type="hidden" name="openid" value="{{$data['openid']}}">
                <input type="hidden" name="nickname" value="{{$data['nickname']}}">
                <input type="hidden" name="avatar" value="{{$data['avatar']}}">
                <input type="hidden" name="worker_id" value="{{$data['worker_id']}}">
                <input type="hidden" name="start" id="start" value="">
                <div class="textarea-group-tips">
                    <span class="fr">还可以输入<em id="textCount">140</em>个字</span>
                </div>
            </div>
        </form>

            <div class="form-submit">
                <button type="button" class="form-submit-btn" onclick="submit()">确定</button>
            </div>

<script src="{{asset('wap/js/jquery-1.11.2.min.js')}}"></script>
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
        // console.log("index",index);
        $("#start").attr("value",index);
        $(".level").html(byIndexLeve(index-1));
        $("#tag").attr("value",byIndexLeve(index-1));
        // console.log(byIndexLeve(index-1));
        $(".order-evaluation ul li:eq(0)").find("img").attr("src","{{asset('assets/img/x1.png')}}");
        for (var i=0;i<index;i++){
            $(".order-evaluation ul li:eq(0)").find("img").eq(i).attr("src","{{asset('assets/img/x2.png')}}");
        }
    });
    //印象
    //评价字数限制
    function words_deal()
    {
        var curLength=$("#TextArea1").val().length;
        if(curLength>140)
        {
            var num=$("#TextArea1").val().substr(0,140);
            $("#TextArea1").val(num);
            alert("超过字数限制，多出的字将被截断！" );
        }
        else
        {
            $("#textCount").text(140-$("#TextArea1").val().length);
        }
    }
</script>
<script>
    function submit(){

        var formData = new FormData($('#evaluate_form')[0]);

        $.ajax({
            type: 'POST',
            url: '{{route('storeEvaluate')}}',
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
                    confirmButtonText:'确定',
                    // timer: 2000
                })
                // alert(data.message)
                {{--setTimeout(function(){--}}
                    {{--location.href = '{{url('m/worker/info/index').'?worker_id='.$data['worker_id']}}';--}}
                {{--},2000);--}}

            }
        })

    }
</script>
</body>
</html>
