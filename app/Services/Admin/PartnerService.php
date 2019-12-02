<?php

namespace App\Services\Admin;


use App\Constants\BaseConstants;
use App\Exceptions\ServiceException;
use App\Models\ProjectCheck;
use App\Models\ProjectDeposit;
use Illuminate\Http\Request;

class PartnerService
{

    /**
     * 合作项目列表
     * @param Request $request
     * @return mixed
     */
    public function indexAjax(Request $request)
    {
        $limit   = $request->input('limit');
        $project = ProjectDeposit::whereMerchantId(\Auth::user()->id)->whereRemark(1)->paginate($limit);

        foreach ($project as $item)
        {
            $item['project_name'] = "<a href='".url('detail/'.$item['project_id'])."' target='_blank'>".getProjectName($item['project_id'])."</a>";
            $item['button']       = $this->getButton($item['check_status'],$item['project_id'],$item['pr_mer_id']);
//            $item['status']       = $this->projectStatus($item['check_status']);

        }

        $array['page'] = $project->currentPage();
        $array['rows'] = $project->items();
        $array['total'] = $project->total();
        return $array;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function checkStore(Request $request)
    {
        $proId   = $request->input('project_id');
        $content = $request->input('content');
        try{
            \DB::beginTransaction();
            $model   = new ProjectCheck();
            $model->project_id  = $proId;
            $model->merchant_id = \Auth::user()->id;
            $model->content     = $content;
            $model->save();
            $proModel = ProjectDeposit::whereProjectId($proId)
                ->whereMerchantId(\Auth::user()->id)
                ->whereCheckStatus(BaseConstants::ORDER_STATUS_COOPERATION)
                ->first();
//        dd($proModel);
            if (!$proModel){
                return response()->json(['message'=>"未找到该笔订单"],422);
//
            }
            $proModel->check_status = BaseConstants::ORDER_STATUS_CHECK;//修改为确认验收报告转态
            $proModel->status       = BaseConstants::ORDER_STATUS_WAIT_FOR_CHECK;//修改为已提交验收报告
            $proModel->update();
            \DB::commit();

        }catch (\Exception $exception){
            \DB::rollBack();
            throw new ServiceException(422, "未找到该笔订单!");

        }
        return response()->json(['message'=>'检测报告提交成功']);

    }

    /**
     * 确认验收报告
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmCheck(Request $request)
    {
        $proModel = ProjectDeposit::whereProjectId($request->input('id'))
                    ->whereMerchantId(\Auth::user()->id)
                    ->whereCheckStatus(BaseConstants::ORDER_STATUS_WAIT_FOR_CHECK)
                    ->first();
        $proModel->check_status = BaseConstants::ORDER_STATUS_EVALUATE;//修改为已提交验收报告
        $proModel->status       = BaseConstants::ORDER_STATUS_EVALUATE;//修改为确认验收报告
        $proModel->update();
        return response()->json(['message'=>'确认成功']);
    }

//    public function projectStatus($status)
//    {
//        switch ($status){
//
//            case 0:
//                $status = '未合作';
//                break;
//            case 1:
//                $status = '未合作';
//                break;
//            case 2:
//                $status = '合作中';
//                break;
//            case 3:
//                $status = '完成';
//                break;
//            case 4:
//                $status = '完成';
//                break;
//
//        }
//        return $status;
//    }

    public function getButton($status,$pId,$prMerId)
    {

        switch ($status) {
            case BaseConstants::ORDER_STATUS_INIT:
                $status = "<button class=\"btn btn-outline-info btn-sm m-r-5\" >待合作</button>";
                break;
            case BaseConstants::ORDER_STATUS_COOPERATION:
                $status = "<button type=\"button\" class=\"btn btn-outline-secondary btn-sm\" >合作中</button>".
                          "<button type=\"button\" class=\"btn btn-outline-danger btn-sm\" onclick='check($pId)'>提交验收报告</button>";
                break;
            case BaseConstants::ORDER_STATUS_CLOSE:
                $status = "<button  class=\"btn btn-success btn-sm\">未合作</button>";
                break;
            case BaseConstants::ORDER_STATUS_CHECK:
                $status = "<button  class=\"btn btn-success btn-sm\">已提交验收报告</button>";
                break;
            case BaseConstants::ORDER_STATUS_WAIT_FOR_CHECK:
                $status = "<button  class=\"btn btn-success btn-sm\" onclick='confirm_check($pId)'>确认验收报告</button>";
                break;
            case BaseConstants::ORDER_STATUS_EVALUATE:
                $status = "<a href='".url('admin/evaluate?project_id='.$pId.'&pr_mer_id='.$prMerId)."'><button type=\"button\" class=\"btn btn-outline-danger btn-sm\" > 评价</button></a>";
                break;
            case BaseConstants::ORDER_STATUS_DONE:
                $status = "<button  class=\"btn btn-secondary btn-sm\" disabled>项目已完成</button>";
                break;

        }
        return $status;
    }

}