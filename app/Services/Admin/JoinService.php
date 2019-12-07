<?php

namespace App\Services\Admin;


use App\Constants\BaseConstants;
use App\Exceptions\ServiceException;
use App\Models\Project;
use App\Models\ProjectCheck;
use App\Models\ProjectDeposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class JoinService
{

    public function indexAjax(Request $request)
    {
        $limit   = $request->input('limit');
        $status   = $request->input('status');
        $project = ProjectDeposit::whereMerchantId(\Auth::user()->id)->where(function ($query)use($status){
            if (!empty(is_numeric($status))){
                $query->where('check_status',$status);
            }
        })->paginate($limit);
        foreach ($project as $item) {

            $item['project_name'] = "<a href='".url('detail/'.$item['project_id'])."' target='_blank'>".getProjectName($item['project_id'])."</a>";
            $item['deposit']      = exchangeToYuan( $item['deposit']);
            $item['deposit_type'] = $this->depositType($item['deposit_type']);
            $item['check']       =   $this->getButton($item['check_status'],$item['project_id'],$item['pr_mer_id']);
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
        $projectId = $request->input('project_id');
        $file   = $request->file('project');
        $files = $file->store('checks');
        $filePath = Storage::url($files);
        try{
            \DB::beginTransaction();
            $model   = new ProjectCheck();
            $model->project_id  = $projectId;
            $model->merchant_id = \Auth::user()->id;
            $model->content     = $filePath;
            $model->save();
            $proModel = ProjectDeposit::whereProjectId($projectId)
                ->whereMerchantId(\Auth::user()->id)
                ->whereCheckStatus(BaseConstants::ORDER_STATUS_COOPERATION)
                ->first();
            if (!$proModel){
                return response()->json(['message'=>"未找到该笔订单"],422);
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
        $projectModel = Project::whereId($proModel->project_id)->first();//完成该项目并改变项目转态为关闭
        $projectModel->status = 1;
        $projectModel->update();
        return response()->json(['message'=>'确认成功']);
    }

    public function depositType($type)
    {
        switch ($type){
            case 1:
                $type = '已付款';
                break;
            case 2:
                $type = '已退款';
                break;
        }
        return $type;
    }

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
                $status = "<button  class=\"btn btn-success btn-sm\" onclick='confirm_check($pId,$prMerId)'>确认验收报告</button>";
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