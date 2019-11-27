<?php

namespace App\Http\Controllers\Admin;


use App\Models\Merchant;
use App\Models\Project;
use App\Models\ProjectOrder;
use App\Models\Worker;
use App\Services\Admin\EvaluateService;
use Illuminate\Http\Request;

class EvaluateController
{

    protected $evaluateService;

    public function __construct(EvaluateService $evaluateService)
    {
        $this->evaluateService = $evaluateService;
    }
    public function index(Request $request)
    {
        $proId = $request->input('project_id');
        $proModel = Project::whereId($proId)->first();
        $merModel = Merchant::whereId($proModel->merchant_id)->first();
        return view('admin.evaluate.index',compact('proModel','merModel'));
    }

    /**
     * 评价项目发布方（甲方）
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function evaluateProjectSide(Request $request)
    {
        $data =$this->evaluateService->setEvaluate($request);
        return $data;
    }

    public function ProjectSide(Request $request)
    {
        $model = ProjectOrder::whereOrderNo($request->input('order_num'))->first();
        $merchantModel = Merchant::whereId($model->merchant_id)->first();
        $worker = $this->getWorkers(json_decode($model->worker_id),$model->project_id );
//        dd($worker);
        return view('admin.evaluate.project_side',compact('merchantModel','worker','model'));
    }


    /**
     * 评价商户方
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function evaluateMerchant(Request $request)
    {
        $data =$this->evaluateService->setEvaluateMerchant($request);
        return $data;
    }

    public function getWorkers(array $id,$projectId)
    {

        $data = [];
        foreach ($id as $item){
            $i =[];
            $workerModel      = Worker::whereId(intval($item))->first();
            $i['worker_name'] = $workerModel->name;
            $i['worker_id']   = $workerModel->id;
            $i['project_id']   = $projectId;
            $data[] =$i;
        }
        return $data ;
    }
}