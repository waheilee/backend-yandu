<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\ProjectCheck;
use App\Services\Admin\JoinService;
use Illuminate\Http\Request;

class JoinController extends Controller
{
    protected $joinService;

    public function __construct(JoinService $joinService)
    {
        $this->joinService = $joinService;
    }

    public function index()
    {
        return view('admin.join.index');
    }

    public function indexRequest(Request $request)
    {
        $data =$this->joinService->indexAjax($request);
        return $data;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function check(Request $request)
    {
        $data =$this->joinService->checkStore($request);
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
        $data =$this->joinService->confirmCheck($request);
        return $data;
    }

    public function download(Request $request)
    {
        $projectId = $request->input('project_id');
        $prMerId = $request->input('pro_mer_id');
        $model = ProjectCheck::whereProjectId($projectId)->whereMerchantId($prMerId)->first();
        $data['url'] = "<a href='".$model->content."'>点击下载查看检测报告</a>";
        return response()->json($data);
    }
}