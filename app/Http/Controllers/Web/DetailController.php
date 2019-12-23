<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;

use App\Models\OrderMerchant;
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
            $projectOrder = ProjectOrder::whereProjectId($id)->whereMerchantId($userId)->first();
            $deposit      = OrderMerchant::whereOrderNum($projectOrder->order_no)->wherePayStatus(1)->first();
            $project      = Project::whereId($id)->whereMerchantId($userId)->first();
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

        $model = OrderMerchant::whereOrderNum($request->input('order'))->wherePayStatus(1)->first();
        if ($model){
            return response()->json(['message'=>'支付成功']);
        }else{
            return response()->json(['message'=>'未支付'],422);
        }
    }


}