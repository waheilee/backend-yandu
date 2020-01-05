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
    <link rel="stylesheet" href="{{asset('assets/css/argon.css?v=1.1.0')}}" type="text/css">
</head>

<body>
<div class="user-top">
    <div class="header user-header">
        <div class="header-msg">
            <a href="../User/MyMessage.html"></a>
        </div>

        <div class="header-setting">
            {{--<a href="../User/Setting.html"></a>--}}
        </div>
    </div>

    <div class="user-info">
        <div class="container-fluid">
            <div class="row">
                <div class="user-photo " >
                    <img src="{{asset('wap/images/member.png')}}" >
                </div>
                <div class="">
                    <div class="text-white text-xs ">姓名: {{$worker->name}}</div>
                    <div class="text-white text-xs ">年龄：{{$worker->age}}</div>
                    <div class="text-white text-xs ">电话：{{$worker->phone}}</div>
                    <div class="text-white text-xs ">职业：{{$worker->tec}}</div>
                </div>
            </div>

        </div>

        <div   class="text text-sm  text-white ">
        <p style="font-size: 1px">险种：雇主责任险  有效期：2019-12-21至2020-12-20</p>
        </div>
        <div class="user-wallet">
            <ul>
                <li>
                    <h3><span>好评率:</span>88%</h3>
                </li>

                <li>
                    <h3><span>接单数:</span>566</h3>
                </li>

            </ul>
        </div>
    </div>


</div>

<div class="user-container">
    <div class="index-panel">
        <div class="goods-comment comment-list">
            @foreach($evaluate as $eva)
            <div class="goods-comment-list">
                <div class="goods-comment-author">
                    <img src="../../../wap/images/member.png">
                    <span>会员名字</span>

                    <div class="goods-comment-level">
                        {{--{{$eva->start}}--}}
                        @for($i = 1 ; $i <= $eva->start ;$i++ )
                        <i class="active" id="{{$eva[$i]}}"></i>
                        @endfor
                        {{--<i class="active"></i>--}}
                        {{--<i class="active"></i>--}}
                        {{--<i class="active"></i>--}}
                        {{--<i class="active"></i>--}}
                    </div>

                    <span class="fr">{{$eva->created_at}}</span>
                </div>

                <div class="goods-comment-content">
                    <p>{{$eva->content}}</p>
                </div>

            </div>
            <div class="clr"></div>
            @endforeach
            {{--<div class="goods-comment-list">--}}
                {{--<div class="goods-comment-author">--}}
                    {{--<img src="../../../wap/images/member.png">--}}
                    {{--<span>会员名字</span>--}}

                    {{--<div class="goods-comment-level">--}}
                        {{--<i class="active"></i>--}}
                        {{--<i class="active"></i>--}}
                        {{--<i class="active"></i>--}}
                        {{--<i class="active"></i>--}}
                    {{--</div>--}}

                    {{--<span class="fr">2018-3-21</span>--}}
                {{--</div>--}}

                {{--<div class="goods-comment-content">--}}
                    {{--<p>已经是第二次买了，收到包包了，真的不错。老婆非常喜欢，一直夸我！开心</p>--}}
                {{--</div>--}}

            {{--</div>--}}
            {{--<div class="clr"></div>--}}

            {{--<div class="goods-comment-list">--}}
                {{--<div class="goods-comment-author">--}}
                    {{--<img src="../../../wap/images/member.png">--}}
                    {{--<span>会员名字</span>--}}

                    {{--<div class="goods-comment-level">--}}
                        {{--<i class="active"></i>--}}
                        {{--<i class="active"></i>--}}
                        {{--<i class="active"></i>--}}
                        {{--<i class="active"></i>--}}
                        {{--<i class="active"></i>--}}
                    {{--</div>--}}

                    {{--<span class="fr">2018-3-21</span>--}}
                {{--</div>--}}

                {{--<div class="goods-comment-content">--}}
                    {{--<p>已经是第二次买了，收到包包了，真的不错。老婆非常喜欢，一直夸我！开心</p>--}}
                {{--</div>--}}

            {{--</div>--}}
            {{--<div class="clr"></div>--}}
        </div>
    </div>

</div>


<div class="load-more">
    <a href="">点击加载更多</a>
</div>



<!--暂未开放弹窗-->
<div class="popup">
    <div class="popup-box coming-soon">
        <div class="popup-box-content">
            <div class="coming-soon-content">
                <img src="../../../wap/images/coming_soon.png">
                <p>此功能暂未开放，敬请期待</p>
            </div>
        </div>

        <div class="popup-submit">
            <button type="submit" class="confirm-btn">确认</button>
        </div>
    </div>
</div>


<script src="{{asset('wap/js/jquery-1.11.2.min.js')}}"></script>
<script>
    $(function() {

        //公告轮播
        var adtimer;
        var wrap = $(".announce-box ul");
        var len = $(".announce-box ul li").length;
        if(len>1){
            $(".announce-box").hover(function(){
                    clearInterval(adtimer);
                },
                function(){
                    adtimer = setInterval(function(){
                        var first = wrap.find("li:first");
                        var HEIGHT = first.height();
                        first.animate({
                            marginTop:-HEIGHT+'px'
                        },500,function(){
                            first.css('marginTop',0).appendTo(wrap);
                        })
                    },2500)
                }).trigger('mouseleave');
        }

        //var num = 0;
//		var width = 0;
//		var length = $('.announce-box ul li').length;
//
//		for(var i=0; i<length; i++){
//			width += $('.announce-box ul li').eq(i).width();
//		}
//
//		function goLeft() {
//
//			if (num == -parseInt(width)) {
//				num = 0;
//			}
//			num -= 1;
//			$(".announce-box ul").css({
//				marginLeft: num
//			})
//		}
//
//		//设置滚动速度
//		var timer = setInterval(goLeft, 30);
//
//		//设置鼠标经过时滚动停止
//		$(".announce-box ul").hover(function() {
//			clearInterval(timer);
//		},
//		function() {
//			timer = setInterval(goLeft, 30);
//		});

        //顶部滚动效果
        //$(window).scroll(function(){
//
//			if ($(window).scrollTop() >= 20){
//				$("#fixedBg").addClass('user-header-fixed');
//			}
//			else{
//				$("#fixedBg").removeClass('user-header-fixed');
//			}
//		});
    });


    //暂未开放
    $(function(){
        $('.no-open').click(function(){
            $('.popup').fadeIn();

            var h = ($(window).height() - $('.popup-box').height())/2;
            $('.popup-box').css('margin-top',h);
        });

        $('.confirm-btn').click(function(){
            $('.popup').fadeOut();
        });
    });
</script>
</body>
</html>
