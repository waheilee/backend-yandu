<?php

namespace App\Http\Controllers\Wap;


use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Worker;
use App\Models\WorkerEvaluate;
use EasyWeChat\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WorkerInfoController extends Controller
{


    public function weChatUser()
    {
        $user = session('wechat.oauth_user.default');//一句话， 拿到授权用户资料
        return $user;
    }
    /**
     * @param Request $request
     * @return Member|\Illuminate\Contracts\View\Factory|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|\Illuminate\View\View|null|object
     */
    public function index(Request $request)
    {

        $openid = $this->weChatUser()->getOriginal()['openid'];
        $web_openid = $this->weChatUser()->getId();
        $member = Member::where('openid', $this->weChatUser()->getId())->first();
        $worker = Worker::whereId($request->input('worker_id'))->first();
        $evaluate = WorkerEvaluate::where('evaluate_id_b',$worker->id)->paginate();
//        dd($evaluate);
        $points = WorkerEvaluate::where('evaluate_id_b',$worker->id)->sum('point');
        $count  = WorkerEvaluate::where('evaluate_id_b',$worker->id)->count();
        $point  = $points/$count;
        //校验用户是否存在，不存在则把信息保存在数据库
        if (!$member) {
            $member = Member::create([
                'nickname' => $this->weChatUser()->getNickname(),
                'avatar' => $this->weChatUser()->getAvatar(),
                'openid' => $openid,
                'web_openid' => $web_openid,
                'api_token' => hash('sha256', Str::random(60)),
                'deposit' => 0,
                'rent' => 0,
                'policy' => 0,
                'mini_openid' => '-'
            ]);
//            dd($userModel);
            return $member;
        }

//        dd($member);
        return view('wap.worker_info.index',compact('worker','member','evaluate','point'));
    }

    public function evaluate($id)
    {
        $data['worker'] = Worker::whereId($id)->first()->name;
        $data['openid'] = $this->weChatUser()->getOriginal()['openid'];
        $data['nickname'] = $this->weChatUser()->getNickname();
        $data['avatar'] = $this->weChatUser()->getAvatar();
        return view('wap.worker_info.evaluate',compact('data'));
    }

    public function storeEvaluate(Request $request)
    {
        dd($request->all());
    }
}