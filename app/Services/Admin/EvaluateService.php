<?php

namespace App\Services\Admin;


use App\Models\ProjectDeposit;
use App\Models\ProjectEvaluate;
use App\Models\WorkerEvaluate;
use Illuminate\Http\Request;

class EvaluateService
{

    /**
     * 商户对甲方的评价
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setEvaluate(Request $request)
    {
        $start       = $request->input('start');
        $tag         = $request->input('tag');
        $project     = $request->input('project');
        $projectSide = $request->input('project_side');
        $content     = $request->input('content');
        if (empty($start)){
            $start = 5;
            $tag   = '好评';
        }
        $model = new ProjectEvaluate();
        $model->project_id    = $project;
        $model->evaluate_id_a = \Auth::user()->id;
        $model->evaluate_id_b = $projectSide;
        $model->start         = $start;
        $model->tag           = $tag;
        $model->content       = $content;
        $model->save();
        $projectDep = ProjectDeposit::whereMerchantId(\Auth::user()->id)
                    ->whereProjectId($project)
                    ->wherePrMerId($projectSide)
                    ->first();
        $projectDep->check_status = 4;//将项目状态改为完成
        $projectDep->update();
        return response()->json(['message'=>'评价成功']);
    }


    /**
     * 甲方对商户和工人的评价
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function setEvaluateMerchant(Request $request)
    {
        $start       = $request->input('start');
        $tag         = $request->input('tag');
        $project     = $request->input('project');
        $merchantId  = $request->input('merchant_id');
        $content     = $request->input('content');
        $worker      = $request->input('work');
        if (empty($start)){
            $start = 5;
            $tag   = '好评';
        }
        if (empty($content)){
            $content = $tag;
        }
        $model = new ProjectEvaluate();
        $model->project_id    = $project;
        $model->evaluate_id_a = \Auth::user()->id;
        $model->evaluate_id_b = $merchantId;
        $model->start         = $start;
        $model->tag           = $tag;
        $model->content       = $content;
        $model->save();
        $this->workerEvaluate($worker);
        $projectDep = ProjectDeposit::whereMerchantId($merchantId)
                    ->whereProjectId($project)
                    ->wherePrMerId(\Auth::user()->id)
                    ->first();
        $projectDep->status = 4;//将项目状态改为完成
        $projectDep->update();
        return response()->json(['message'=>'评价成功']);
    }

    /**
     * 工人评价
     * @param $work
     */
    public function workerEvaluate($work)
    {
        foreach ($work as $item=>$k)
        {
            if (empty($k['worker_content'])){
                $k['worker_content'] = $this->workerTag($k['worker_start']);
            }
            $model = new WorkerEvaluate();
            $model->project_id    = $k['project_id'];
            $model->evaluate_id_a = \Auth::user()->id;
            $model->evaluate_id_b = $k['worker_id'];
            $model->start         = $k['worker_start'];
            $model->tag           = $this->workerTag($k['worker_start']);
            $model->content       = $k['worker_content'];
            $model->save();
        }

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
}