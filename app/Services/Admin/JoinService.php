<?php

namespace App\Services\Admin;


use App\Models\ProjectDeposit;
use Illuminate\Http\Request;

class JoinService
{

    public function indexAjax(Request $request)
    {
        $limit   = $request->input('limit');
        $project = ProjectDeposit::whereMerchantId(\Auth::user()->id)->paginate($limit);
        foreach ($project as $item) {

            $item['project_name'] = "<a href='".url('detail/'.$item['project_id'])."' target='_blank'>".getProjectName($item['project_id'])."</a>";
            $item['deposit']      = exchangeToYuan( $item['deposit']);
            $item['deposit_type'] = $this->depositType($item['deposit_type']);
            $item['remark']       =   $this->projectStatus($item['remark']);
        }
        $array['page'] = $project->currentPage();
        $array['rows'] = $project->items();
        $array['total'] = $project->total();
        return $array;
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
}