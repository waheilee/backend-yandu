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
        foreach ($project as $item) {
            $item['project_name'] = "<a href='".url('detail/'.$item['project_id'])."' target='_blank'>".getProjectName($item['project_id'])."</a>";
            $item['button']       = $this->getButton($item['remark'],$item['project_id'],$item['check_status']);
            $item['remark']       =   $this->projectStatus($item['remark']);
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
        $model->project_id = $proId;
        $model->merchant_id = 0;
        $model->content = $content;
        $model->save();
        $proModel = ProjectDeposit::whereProjectId($proId)->wherePrMerId(\Auth::user()->id)->whereRemark(1)->first();
        $proModel->check_status = 1;
        $proModel->update();
    }

    public function projectStatus($status)
    {
        switch ($status){
            case '-':
                $status = '正常';
                break;
            case 0:
                $status = '未合作';
                break;
            case 1:
                $status = '已合作';
                break;

        }
        return $status;
    }

    public function getButton($remark,$proId,$cheStatus)
    {
        if ($cheStatus == 1){
            return "<button type=\"button\" class=\"btn btn-outline-danger btn-sm\" onclick='check($proId)'>评价</button>";
        }
        if ($cheStatus == 2){
            return "<button type=\"button\" class=\"btn btn-secondary btn-sm\" >合作项目已完成</button>";
        }
        switch ($remark) {
            case 1:
                $remark = " <button type=\"button\" class=\"btn btn-outline-danger btn-sm\" onclick='check($proId)'>提交验收报告</button>";
                break;
        }
        return $remark;
    }
}