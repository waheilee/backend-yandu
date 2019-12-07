<?php

namespace App\Services\Admin;


use App\Constants\BaseConstants;
use App\Exceptions\ServiceException;
use App\Models\ProjectCheck;
use App\Models\Project;
use App\Models\ProjectDeposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Web\WeChatPayController;
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
            $item['button']   = $this->getButton($item['status'],$item['project_id'],$item['merchant_id'],$item['relate_order']);
        }
        $array['page'] = $project->currentPage();
        $array['rows'] = $project->items();
        $array['total'] = $project->total();
        return $array;
    }



    //选择合作商户

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function getPartner(Request $request)
    {
        $pId      = $request->input('project_id');
        $mId      = $request->input('merchant_id');
        $orderNum = $request->input('order_num');

        $proModel = ProjectDeposit::whereProjectId($pId)->get();
        foreach ($proModel as $item){
            $item->status       = BaseConstants::ORDER_STATUS_CLOSE;//把所有商户状态调整为未合作状态
            $item->check_status = BaseConstants::ORDER_STATUS_CLOSE;//把所有商户状态调整为未合作状态
            $item->update();
        }

        $model = ProjectDeposit::whereProjectId($pId)
                ->whereMerchantId($mId)
                ->whereRelateOrder($orderNum)
                ->first();
        $model->status       = BaseConstants::ORDER_STATUS_COOPERATION;//调整此商户为合作商户
        $model->check_status = BaseConstants::ORDER_STATUS_COOPERATION;//调整此商户为合作商户
        $model->update();
        $refund = ProjectDeposit::whereProjectId($pId)->whereCheckStatus(BaseConstants::ORDER_STATUS_CLOSE)->get();
        //给未选择为合作的商户退款
        foreach ($refund as $temp){
            if ($temp->remark == 'wechat'){
               $wechat = new WeChatPayController();
               $wechat->refund($temp->relate_order);
            }
        }
//        $projectModel = Project::whereId($pId)->first();
//        $projectModel->status = 1;
//        $projectModel->update();
        $data['code'] = 200;
        $data['merchant_name'] = getMerchantName($mId);
        return response()->json($data);
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
                ->wherePrMerId(\Auth::user()->id)
                ->whereStatus(BaseConstants::ORDER_STATUS_COOPERATION)
                ->first();
            if (!$proModel){
                return response()->json(['message'=>"未找到该笔订单"],422);
            }
            $proModel->status       = BaseConstants::ORDER_STATUS_CHECK;//修改为已提交验收报告
            $proModel->check_status = BaseConstants::ORDER_STATUS_WAIT_FOR_CHECK;//修改为确认验收报告转态
            $proModel->update();
            \DB::commit();

        }catch (\Exception $exception){
            \DB::rollBack();
            throw new ServiceException(422, "未找到该笔订单!");

        }
        return response()->json(['message'=>'检测报告提交成功']);

    }

    /**
     * 甲方确认验收报告
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmCheck(Request $request)
    {
        $proModel = ProjectDeposit::whereProjectId($request->input('id'))
            ->wherePrMerId(\Auth::user()->id)
            ->whereStatus(BaseConstants::ORDER_STATUS_WAIT_FOR_CHECK)
            ->first();
        $proModel->status       = BaseConstants::ORDER_STATUS_EVALUATE;//修改为确认验收报告
        $proModel->check_status = BaseConstants::ORDER_STATUS_EVALUATE;//修改为已提交验收报告
        $proModel->update();
        return response()->json(['message'=>'确认成功']);
    }

    public function getButton($status,$pId,$mId,$orderNum)
    {

        switch ($status) {
            case BaseConstants::ORDER_STATUS_INIT:
                $status = "<button class=\"btn btn-outline-info btn-sm m-r-5\" onclick=\"partner('$pId','$mId','$orderNum')\">待合作</button>";
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
                $status = "<button  class=\"btn btn-success btn-sm\" onclick='confirm_check($pId,$mId)'>确认验收报告</button>";
                break;
            case BaseConstants::ORDER_STATUS_EVALUATE:
                $status = "<a href='".url('admin/evaluate/project_side?order_num='.$orderNum)."'><button  class=\"btn btn-success btn-sm\" >评价</button></a>";

                break;
            case BaseConstants::ORDER_STATUS_DONE:
                $status = "<button  class=\"btn btn-secondary btn-sm\" disabled>项目已完成</button>";

                break;

        }
        return $status;

    }
}