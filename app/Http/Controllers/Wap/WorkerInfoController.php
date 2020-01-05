<?php

namespace App\Http\Controllers\Wap;


use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Worker;
use EasyWeChat\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WorkerInfoController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = session('wechat.oauth_user.default');//一句话， 拿到授权用户资料
    }

    /**
     * @param Request $request
     * @return Member|\Illuminate\Contracts\View\Factory|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|\Illuminate\View\View|null|object
     */
    public function index(Request $request)
    {

        $openid = $this->user->getOriginal()['openid'];
        $web_openid = $this->user->getId();
        $member = Member::where('openid', $this->user->getId())->first();
        $worker = Worker::whereId($request->input('worker_id'))->first();
        //校验用户是否存在，不存在则把信息保存在数据库
        if (!$member) {
            $member = Member::create([
                'nickname' => $this->user->getNickname(),
                'avatar' => $this->user->getAvatar(),
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
        return view('wap.worker_info.index',compact('worker','member'));
    }
}