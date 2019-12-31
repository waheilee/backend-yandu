<?php

namespace App\Services\Admin;


use App\Constants\BaseConstants;
use App\Models\MemberPolicy;
use Illuminate\Http\Request;

class PolicyEmployerService
{

    public function indexAjax(Request $request)
    {
        $limit   = $request->input('limit');
        $project = MemberPolicy::wherePolicyType(BaseConstants::POLICY_TYPE_EMPLOYER)->whereMerchantId(\Auth::guard('admin')->user()->id)->paginate($limit);
        foreach ($project as $item) {
            $status = $this->status($item->status,json_encode($item->order_no)) ;
            $item['pay_status'] = $status['status'];
            $item['button']     = $status['button'];
        }
        $array['page'] = $project->currentPage();
        $array['rows'] = $project->items();
        $array['total'] = $project->total();
        return $array;
    }

    public function status($payStatus,$order)
    {
        $data = [];
        if ($payStatus === null){
            $data['status'] = "-";
            $data['button'] = "-";
            return $data;
        }
        switch ($payStatus){
            case 0:
                $data['status'] = "<span class='tag badge badge-danger'>未付款</span>";
                $data['button'] = "<button class='btn btn-primary btn-sm' onclick='pay($order)'>去支付</button>";
                break;
            case 1:
                $data['status'] = "<span class='tag badge badge-info'>暂未生效</span>";
                $data['button'] = "<button class='btn btn-primary btn-sm'></button>";
                break;
            case 2:
                $data['status'] = "<span class='tag badge badge-success'>有效保单</span>";
                $data['button'] = "<button class='btn btn-primary btn-sm'></button>";
                break;
            case 3:
                $data['status'] = "<span class='tag badge badge-warning'>已过期，请续费</span>";
                $data['button'] = "<button class='btn btn-warning btn-sm' onclick='pay($order)'>续费</button>";
                break;

        }
        return $data;
    }
}