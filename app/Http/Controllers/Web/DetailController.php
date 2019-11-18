<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;

use App\Models\Project;
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
            return view('web.detail.index',compact('userId','article','merInfo'));
        }else{
            return view('web.detail.index',compact('article'));
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




}