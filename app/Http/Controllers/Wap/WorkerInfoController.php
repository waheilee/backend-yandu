<?php

namespace App\Http\Controllers\Wap;


use App\Http\Controllers\Controller;
use App\Models\Member;
use EasyWeChat\Factory;
class WorkerInfoController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = session('wechat.oauth_user.default'); //一句话， 拿到授权用户资料
//        dd($user->getId());
        $member = Member::where('openid', $user->getId())->first();
        dd($member);
        return view('wap.worker_info.index');
    }
}