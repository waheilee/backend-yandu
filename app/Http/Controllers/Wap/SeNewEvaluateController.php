<?php

namespace App\Http\Controllers\Wap;


use App\Models\Worker;
use Illuminate\Http\Request;

class SeNewEvaluateController
{

    public function weChatUser()
    {
        $user = session('wechat.oauth_user.default');//一句话， 拿到授权用户资料
        return $user;
    }

    public function index($id)
    {
        $data['worker'] = Worker::whereId($id)->first()->name;
        $data['openid'] = $this->weChatUser()->getOriginal()['openid'];
        $data['nickname'] = $this->weChatUser()->getNickname();
        $data['avatar'] = $this->weChatUser()->getAvatar();
        $data['worker_id'] = $id;
        return view('wap.se_new.evaluate.index',compact('data'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}