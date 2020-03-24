<?php

namespace App\Services\Admin;


use App\Models\Air;
use Illuminate\Http\Request;

class AirService
{


    public function indexAjax(Request $request)
    {
        $limit   = $request->input('limit');
        $project = Air::whereUserId(auth()->id())->paginate($limit);
        foreach ($project as $item) {
            $item['status']       = $this->getStatus($item['status']);

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
}