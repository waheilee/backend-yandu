<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Models\ProjectDeposit;
use App\Models\ProjectOrder;
use Illuminate\Http\Request;
use App\Services\Web\DetailService;

class DetailController extends Controller
{

    protected $detailService;

    public function __construct(DetailService $detailService)
    {
        $this->detailService = $detailService;
    }

    public function index($id)
    {
        $article = Project::whereId($id)->first();
        $user = \Auth::guard('admin')->user();
        $merInfo = $this->detailService->getIntentionMerchant($id);
        if ($user){
            $userId = $user->id;
            $deposit = ProjectDeposit::whereProjectId($id)->whereMerchantId($userId)->first();
            $project = Project::whereId($id)->whereMerchantId($userId)->first();
//            dd( $project);
            return view('web.detail.index',compact('userId','article','merInfo','deposit','project'));
        }else{
            $deposit = null;
            $project = null;
            return view('web.detail.index',compact('article','deposit','project'));
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function merchantInfo(Request $request)
    {
        $data = $this->detailService->getMerchantInfo($request);
        return $data;
    }


    /**
     * @param Request $request
     * @return string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function intention(Request $request)
    {
       $data = $this->detailService->getIntention($request);
       return $data;
    }


    public function notify(Request $request)
    {
        $model = ProjectOrder::whereMerchantId($request->input('merchant_id'))
                            ->whereProjectId($request->input('project_id'))
                            ->wherePayStatus(1)
                            ->whereChannel($request->input('pay_type'))
                            ->first();
        if ($model){
            return response()->json(['message'=>'支付成功']);
        }else{
            return false;
        }
    }


}