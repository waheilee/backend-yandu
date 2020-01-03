<?php

namespace App\Http\Controllers\Wap;


use App\Http\Controllers\Controller;
use EasyWeChat\Factory;
class WeChatController extends Controller
{

    /**
     * @throws \EasyWeChat\Kernel\Exceptions\BadRequestException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function serve()
    {
        $config = config('wechat.official_account');

        $app = Factory::officialAccount($config);

        $response = $app->server->serve();

// 将响应输出
        $response->send();exit; // Laravel 里请使用：return $response;
    }
}