<?php

namespace App\Services\Admin;


use App\Models\Merchant;
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
            $item['merchant_name']  = $this->getMerchantName($item['merchant_id']);
            $item['project_name']   = $this->getProjectName($item['project_id']);
            $item['button']   = $this->getButton($item['remark'],$item['project_id'],$item['merchant_id'],$item['relate_order']);
        }
        $array['page'] = $project->currentPage();
        $array['rows'] = $project->items();
        $array['total'] = $project->total();
        return $array;
    }

    //本项目中商户的公司名称
    public function getMerchantName($id)
    {
        $merchantModel = Merchant::whereId($id)->first();
        return $merchantModel->company;
    }

    //本项目的相名称
    public function getProjectName($id)
    {
        $merchantModel = Project::whereId($id)->first();
        return $merchantModel->project_name;
    }

    //选择合作商户
    public function getPartner(Request $request)
    {
        $pId = $request->input('project_id');
        $mId = $request->input('merchant_id');
        $orderNum = $request->input('order_num');
//        dd($request->all());
        $proModel = ProjectDeposit::whereProjectId($pId)->get();
        foreach ($proModel as $item){
            $item->remark = 0;
            $item->update();
        }
        $model = ProjectDeposit::whereProjectId($pId)->whereMerchantId($mId)->whereRelateOrder($orderNum)->first();
        $model->remark = 1;
        $model->update();
        $data['code'] = 200;
        $data['merchant_name'] = $this->getMerchantName($mId);
        return response()->json($data);
    }

    public function getButton($remark,$pId,$mId,$orderNum)
    {

        switch ($remark) {
            case '-':
                $remark = " <button class=\"btn btn-outline-info btn-sm m-r-5\" onclick=\"partner('$pId','$mId','$orderNum')\">选择为合作伙伴</button>";
                break;
            case 0:
                $remark = " <button type=\"button\" class=\"btn btn-outline-secondary btn-sm\" >未成为合作伙伴</button>";
                break;
            case 1:
                $remark = " <button type=\"button\" class=\"btn btn-outline-danger btn-sm\">已成为合作伙伴</button>";
                break;

        }
        return $remark;

    }
}