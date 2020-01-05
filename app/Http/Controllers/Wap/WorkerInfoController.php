<?php

namespace App\Http\Controllers\Wap;


use App\Http\Controllers\Controller;

class WorkerInfoController extends Controller
{

    public function index()
    {
        $user = session('wechat.oauth_user.default'); //一句话， 拿到授权用户资料
        dd($user);
        return view('wap.worker_info.index');
    }
}