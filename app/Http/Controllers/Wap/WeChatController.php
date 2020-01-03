<?php

namespace App\Http\Controllers\Wap;


use App\Http\Controllers\Controller;

class WeChatController extends Controller
{


    public function serve()
    {
        $wechat = app('wechat');

        $server = $wechat->server;
        $user = $wechat->user;

        $server->push(function($message) use ($user) {
            $fromUser = $user->get($message['FromUserName']);

            return "{$fromUser->nickname} 您好！这里是严度服务平台!";
        });

        $server->serve()->send();
    }
}