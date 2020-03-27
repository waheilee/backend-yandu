<?php

namespace App\Services\Admin;


use App\Models\Air;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AirService
{


    public function indexAjax(Request $request)
    {
        $limit   = $request->input('limit');
        $project = Air::whereUserId(auth()->id())->paginate($limit);
        foreach ($project as $item) {
            $item['status']       = $this->getStatus($item['status']);
            $item['created']   = date('Y-m-d',strtotime($item['created_at']));
            $item['type']   = $this->type($item['type']);

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
                $status = "<button class=\"btn btn btn-secondary btn-sm m-r-5\" >未完成</button>";
                break;
            case 1:
                $status = " <button class=\"btn btn-success btn-sm m-r-5 \" >完成</button>";
                break;
        }
        return $status;
    }

    public function type($data)
    {
        switch ($data) {
            case 1:
                $data = "除甲醛、空气治理";
                break;
            case 2:
                $data = "保洁";
                break;
        }
        return $data;
    }
}