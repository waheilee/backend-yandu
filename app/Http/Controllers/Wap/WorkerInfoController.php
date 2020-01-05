<?php

namespace App\Http\Controllers\Wap;


use App\Http\Controllers\Controller;
use EasyWeChat\Factory;
class WorkerInfoController extends Controller
{

    public function index()
    {
//        $user = session('wechat.oauth_user.default'); //一句话， 拿到授权用户资料
        $user = $_SESSION['wechat.oauth_user.default'];
        dd($user);
        return view('wap.worker_info.index');
    }
}