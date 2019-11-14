<?php

namespace App\Services\Admin;


use App\Models\ProjectDeposit;
use Illuminate\Http\Request;

class JoinService
{

    public function indexAjax(Request $request)
    {
        $limit   = $request->input('limit');
        $project = ProjectDeposit::paginate($limit);
        foreach ($project as $item) {

            $item['project_name'] = "<a href='".url('detail/'.$item['id'])."' target='_blank'>".$item['project_name']."</a>";
            $item['budget']      = exchangeToYuan( $item['budget']);
            $item['status']      = $this->getStatus($item['status']);
            $item['look']      = "<a href='".url('detail/'.$item['id'])."' target='_blank'><button class='btn btn-warning btn-sm'>查看详情</button></a>";
            $item['created'] = date('Y-m-d',strtotime($item['created_at']));
        }
        $array['page'] = $project->currentPage();
        $array['rows'] = $project->items();
        $array['total'] = $project->total();
        return $array;
    }
}