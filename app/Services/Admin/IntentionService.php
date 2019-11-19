<?php

namespace App\Services\Admin;


use App\Models\ProjectCheck;
use App\Models\Project;
use App\Models\ProjectDeposit;
use Illuminate\Http\Request;

class IntentionService
{

    public function indexAjax(Request $request)
    {
        $limit   = $request->input('limit');
        $project = ProjectDeposit::wherePrMerId(\Auth::user()->id)->orderBy('project_id')->paginate($limit);
        foreach ($project as $item) {
            $item['deposit']      = exchangeToYuan( $item['deposit']);
            $item['merchant_name']  = getMerchantName($item['merchant_id']);
            $item['project_name']   = getProjectName($item['project_id']);
            $item['button']   = $this->getButton($item['check_status'],$item['project_id'],$item['merchant_id'],$item['relate_order']);
        }
        $array['page'] = $project->currentPage();
        $array['rows'] = $project->items();
        $array['total'] = $project->total();
        return $array;
    }



    //选择合作商户
    public function getPartner(Request $request)
    {
        $pId      = $request->input('project_id');
        $mId      = $request->input('merchant_id');
        $orderNum = $request->input('order_num');
        $proModel = ProjectDeposit::whereProjectId($pId)->get();
        foreach ($proModel as $item){
            $item->remark = 0;
            $item->update();
        }
        $model = ProjectDeposit::whereProjectId($pId)->whereMerchantId($mId)->whereRelateOrder($orderNum)->first();
        $model->remark       = 1;
        $model->check_status = 2;
        $model->update();
        $projectModel = Project::whereId($pId)->first();
        $projectModel->status = 1;
        $projectModel->update();
        $data['code'] = 200;
        $data['merchant_name'] = getMerchantName($mId);
        return response()->json($data);
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
        $proModel->update();
        return response()->json(['message'=>'检测报告提交成功']);
    }

    public function getButton($status,$pId,$mId,$orderNum)
    {

        switch ($status) {
            case 0:
                $status = "<button class=\"btn btn-outline-info btn-sm m-r-5\" onclick=\"partner('$pId','$mId','$orderNum')\">选择为合作伙伴</button>";
                break;
            case 1:
                $status = "<button type=\"button\" class=\"btn btn-outline-secondary btn-sm\" >未成为合作伙伴</button>";
                break;
            case 2:
                $status = "<button  class=\"btn btn-success btn-sm\">已成为合作伙伴</button>".
                          "<button type=\"button\" class=\"btn btn-outline-danger btn-sm\" onclick='check($pId)'>提交验收报告</button>";
                break;
            case 3:
                $status = "<button  class=\"btn btn-success btn-sm\" >评价</button>";
                break;
            case 4:
                $status = "<button  class=\"btn btn-secondary btn-sm\" disabled>此项目已完成</button>";
                break;

        }
        return $status;

    }
}