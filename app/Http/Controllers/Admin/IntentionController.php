<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\ProjectCheck;
use App\Services\Admin\IntentionService;
use Illuminate\Http\Request;

class IntentionController extends Controller
{

    protected $intentionService;

    public function __construct(IntentionService $intentionService)
    {
        $this->intentionService = $intentionService;
    }

    public function index()
    {
        return view('admin.intention.index');
    }

    public function indexRequest(Request $request)
    {
        $data =$this->intentionService->indexAjax($request);
        return $data;
    }

    /**
     * 选择合作意向商户
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function partner(Request $request)
    {
       $data = $this->intentionService->getPartner($request);
       return $data;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function check(Request $request)
    {
        $data =$this->intentionService->checkStore($request);
        return $data;
    }

    /**
     * 确认验收报告
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Yansongda\Pay\Exceptions\GatewayException
     * @throws \Yansongda\Pay\Exceptions\InvalidConfigException
     * @throws \Yansongda\Pay\Exceptions\InvalidSignException
     */
    public function confirm(Request $request)
    {
        $data =$this->intentionService->confirmCheck($request);
        return $data;
    }

    public function download(Request $request)
    {
        $projectId = $request->input('project_id');
        $MerId = $request->input('mer_id');
        $model = ProjectCheck::whereProjectId($projectId)->whereMerchantId($MerId)->first();
        $data['url'] = "<a href='".$model->content."'>点击下载查看检测报告</a>";
        return response()->json($data);
    }
}