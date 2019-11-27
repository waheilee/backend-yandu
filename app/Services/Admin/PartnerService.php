<?php

namespace App\Services\Admin;


use App\Models\ProjectCheck;
use App\Models\ProjectDeposit;
use Illuminate\Http\Request;

class PartnerService
{

    public function indexAjax(Request $request)
    {
        $limit   = $request->input('limit');
        $project = ProjectDeposit::whereMerchantId(\Auth::user()->id)->whereRemark(1)->paginate($limit);

        foreach ($project as $item)
        {
            $item['project_name'] = "<a href='".url('detail/'.$item['project_id'])."' target='_blank'>".getProjectName($item['project_id'])."</a>";
            $item['button']       = $this->getButton($item['check_status'],$item['project_id'],$item['pr_mer_id']);
            $item['status']       = $this->projectStatus($item['check_status']);

        }

        $array['page'] = $project->currentPage();
        $array['rows'] = $project->items();
        $array['total'] = $project->total();
        return $array;
    }

    public function checkStore(Request $request)
    {
        $proId = $request->input('project_id');
        $content = $request->input('content');
        $model = new ProjectCheck();
        $model->project_id  = $proId;
        $model->merchant_id = \Auth::user()->id;
        $model->content     = $content;
        $model->save();
        $proModel = ProjectDeposit::whereProjectId($proId)->wherePrMerId(\Auth::user()->id)->whereCheckStatus(2)->first();
        $proModel->check_status = 3;//修改为评价状态
        $proModel->status = 3;//修改为评价状态
        $proModel->update();
        return response()->json(['message'=>'检测报告提交成功']);

    }

    public function projectStatus($status)
    {
        switch ($status){

            case 0:
                $status = '未合作';
                break;
            case 1:
                $status = '未合作';
                break;
            case 2:
                $status = '合作中';
                break;
            case 3:
                $status = '完成';
                break;
            case 4:
                $status = '完成';
                break;

        }
        return $status;
    }

    public function getButton($status,$pId,$prMerId)
    {

        switch ($status) {
            case 0:
                $status = "未合作";
                break;
            case 1:
                $status = "未合作";
                break;
            case 2:
                $status = " <button type=\"button\" class=\"btn btn-outline-danger btn-sm\" onclick='check($pId)'>提交验收报告</button>";
                break;
            case 3:
                $status = " <a href='".url('admin/evaluate?project_id='.$pId.'&pr_mer_id='.$prMerId)."'><button type=\"button\" class=\"btn btn-outline-danger btn-sm\" > 评价</button></a>";
                break;
            case 4:
                $status = " <button type=\"button\" class=\"btn btn-outline-danger btn-sm\" >完成此项目</button>";
                break;
        }
        return $status;
    }
}