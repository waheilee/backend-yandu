<?php

namespace App\Services\Admin;


use App\Models\Project;
use Illuminate\Http\Request;

class DemandService
{

    public function indexAjax(Request $request)
    {
        $limit   = $request->input('limit');
        $project = Project::paginate($limit);
        foreach ($project as $item) {
            $item['project_name'] = "<a href='".url('detail/'.$item['id'])."' target='_blank'>".$item['project_name']."</a>";
            $item['budget']       = exchangeToYuan( $item['budget']);
            $item['status']       = $this->getStatus($item['status']);
            $item['look']         = "<a href='".url('detail/'.$item['id'])."' target='_blank'><button class='btn btn-warning btn-sm'>查看详情</button></a>";
            $item['worker']       = $item['people_num'].'人';
            $item['created']      = date('Y-m-d',strtotime($item['created_at']));
            $item['address']      = $item['province'].'.'.$item['city'].'.'.$item['county'];

        }
        $array['page'] = $project->currentPage();
        $array['rows'] = $project->items();
        $array['total'] = $project->total();
        return $array;
    }

    public function getStatus($status)
    {
        switch ($status) {
            case 0:
                $status = "<button class=\"btn btn-success btn-sm m-r-5\" >正常</button>";
                break;
            case 1:
                $status = " <button class=\"btn btn btn-secondary btn-sm m-r-5\" >关闭</button>";
                break;
        }
        return $status;
    }
}