
@foreach($evaluate as $eva)
    <div class="goods-comment-list">
        <div class="goods-comment-author">
            <img src=" @if(!$eva->wechat_avatar) ../../../wap/images/member.png @else {{$eva->wechat_avatar}} @endif">
            <span>@if(!$eva->wechat_nickname)匿名@else{{$eva->wechat_nickname}}@endif</span>

            <div class="goods-comment-level">
                {{--{{$eva->start}}--}}
                @for($i = 1 ; $i <= $eva->start ;$i++ )
                    <i class="active" id="{{$eva[$i]}}"></i>
                @endfor
            </div>

            <span class="fr">{{$eva->created_at}}</span>
        </div>

        <div class="goods-comment-content">
            <p>{{$eva->content}}</p>
        </div>

    </div>
    <div class="clr"></div>
    {{--<div class="text-right">--}}
        {{--<button class="btn btn-success">Read More</button>--}}
    {{--</div>--}}

    <hr style="margin-top:5px;">
@endforeach