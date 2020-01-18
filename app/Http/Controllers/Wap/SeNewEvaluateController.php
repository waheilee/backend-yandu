<?php

namespace App\Http\Controllers\Wap;


use App\Models\Member;
use App\Models\Worker;
use App\Models\WorkerEvaluate;
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
        $openid = $request->input('openid');
        $nickname = $request->input('nickname');
        $avatar = $request->input('avatar');
        $start = $request->input('start');
        $tag   = $request->input('tag');
        $content = $request->input('content');
        $workerId = $request->input('worker_id');
        $member = Member::whereOpenid($openid)->first()->id;
        $point = $this->point($start);
        $evaluateModel = new WorkerEvaluate();
        $evaluateModel->project_id = 0;
        $evaluateModel->evaluate_id_a = $member;
        $evaluateModel->evaluate_id_b = $workerId;
        $evaluateModel->start = $start;
        $evaluateModel->tag = $tag;
        $evaluateModel->content = $content;
        $evaluateModel->point = $point;
        $evaluateModel->openid = $openid;
        $evaluateModel->wechat_avatar = $avatar;
        $evaluateModel->wechat_nickname = $nickname;
        $evaluateModel->save();
        return response()->json(['评价成功']);
//        dd($request->all());
    }

    public function point($start)
    {
        switch ($start){
            case 1:
                $start = 30;
                break;
            case 2:
                $start = 70;
                break;
            case 3:
                $start = 100;
                break;

        }
        return $start;
    }
}