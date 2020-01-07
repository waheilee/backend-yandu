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
        $evaluate = WorkerEvaluate::where('evaluate_id_b',$worker->id)->paginate(6);
//        dd($evaluate);
        $points = WorkerEvaluate::where('evaluate_id_b',$worker->id)->sum('point');
        $count  = WorkerEvaluate::where('evaluate_id_b',$worker->id)->count();
        $point  = round($points/$count,2);
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
        return view('wap.worker_info.index',compact('worker','member','evaluate','point','count'));
    }

    public function evaluate($id)
    {
        $data['worker'] = Worker::whereId($id)->first()->name;
        $data['openid'] = $this->weChatUser()->getOriginal()['openid'];
        $data['nickname'] = $this->weChatUser()->getNickname();
        $data['avatar'] = $this->weChatUser()->getAvatar();
        $data['worker_id'] = $id;
        return view('wap.worker_info.evaluate',compact('data'));
    }

    public function storeEvaluate(Request $request)
    {
        $content = $request->input('content');
        $openid = $request->input('openid');
        $nickname = $request->input('nickname');
        $avatar = $request->input('avatar');
        $start = $request->input('start');
        $workerId = $request->input('worker_id');
        $member = Member::whereOpenid($openid)->first()->id;
        $point = $this->point($start);
        $evaluateModel = new WorkerEvaluate();
        $evaluateModel->project_id = 0;
        $evaluateModel->evaluate_id_a = $member;
        $evaluateModel->evaluate_id_b = $workerId;
        $evaluateModel->start = $start;
        $evaluateModel->tag = $this->workerTag($start);
        $evaluateModel->content = $content;
        $evaluateModel->point = $point;
        $evaluateModel->openid = $openid;
        $evaluateModel->wechat_avatar = $avatar;
        $evaluateModel->wechat_nickname = $nickname;
        $evaluateModel->save();
        return response()->json(['message'=>'评价成功']);
//        dd($request->all());
    }

    public function point($start)
    {
        switch ($start){
            case 1:
                $start = 20;
                break;
            case 2:
                $start = 40;
                break;
            case 3:
                $start = 60;
                break;
            case 4:
                $start = 80;
                break;
            case 5:
                $start = 100;
                break;
        }
        return $start;
    }

    public function workerTag($tag)
    {
        switch ($tag) {
            case 1:
                $tag="差评";
                break;
            case 2:
                $tag="较差";
                break;
            case 3:
                $tag="中等";
                break;
            case 4:
                $tag="一般";
                break;
            case 5:
                $tag="好评";
                break;
        }
        return $tag;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function dataAjax(Request $request)
    {
        $evaluate = WorkerEvaluate::where('evaluate_id_b',$request->get('worker_id'))->paginate(6);
        $view = view('wap.worker_info.data-ajax',compact('evaluate'))->render();
        return response()->json(['html'=>$view]);
    }

}