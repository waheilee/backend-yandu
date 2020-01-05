<?php

namespace App\Http\Controllers\Wap;


use App\Http\Controllers\Controller;
use App\Models\Member;
use EasyWeChat\Factory;
use Illuminate\Support\Str;

class WorkerInfoController extends Controller
{
    /**
     * @return Member|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     */
    public function index()
    {
        $user = session('wechat.oauth_user.default'); //一句话， 拿到授权用户资料
        $openid = $user->getOriginal()['openid'];
        $web_openid = $user->getId();
        $member = Member::where('openid', $user->getId())->first();
        //校验用户是否存在，不存在则把信息保存在数据库
        if (!$member) {
            $userModel = Member::create([
                'nickname' => $user->getNickname(),
                'avatar' => $user->getAvatar(),
                'openid' => $openid,
                'web_openid' => $web_openid,
                'api_token' => hash('sha256', Str::random(60)),
                'deposit' => 0,
                'rent' => 0,
                'policy' => 0,
                'mini_openid' => '-'
            ]);
            dd($userModel);
            return $userModel;
        }else{
            dd($member);
            return $member;
        }

//        dd($member);
//        return view('wap.worker_info.index');
    }
}