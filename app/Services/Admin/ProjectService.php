<?php

namespace App\Services\Admin;


use Illuminate\Http\Request;
use App\Models\Project;

class ProjectService
{
    public function indexAjax(Request $request)
    {
        $limit   = $request->input('limit');
        $project = Project::whereMerchantId(\Auth::user()->id)->paginate($limit);
        foreach ($project as $item) {
            $item['project_name'] = "<a href='".url('detail/'.$item['id'])."' target='_blank'>".$item['project_name']."</a>";
            $item['cash_deposit'] = exchangeToYuan($item['cash_deposit']);
            $item['budget']       = exchangeToYuan($item['budget']);

        }
        $array['page'] = $project->currentPage();
        $array['rows'] = $project->items();
        $array['total'] = $project->total();
        return $array;
    }

    /**
     * 添加项目
     * @param Request $request
     * @return bool
     */
    public function createProject(Request $request)
    {
        $proModel = new Project();
        $proModel->num = time();
        $proModel->merchant_id  = auth()->id();
        $proModel->project_name = $request->input('project_name');
        $proModel->address      = $request->input('address');
        $proModel->begin_time   = $request->input('begin_time');
        $proModel->end_time     = $request->input('end_time');
        $proModel->size         = $request->input('size');
        $proModel->cash_deposit = exchangeToFen($request->input('cash_deposit'));
        $proModel->budget       = exchangeToFen($request->input('budget'));
        $proModel->people_num   = $request->input('people_num');
        $proModel->phone        = $request->input('phone');
        $proModel->project_time = $this->diffBetweenTwoDays($request->input('begin_time'),$request->input('end_time')).'天';
        $proModel->content      = $request->input('content');
        return $proModel->save();
    }
    /**
     * 求两个日期之间相差的天数，算出工程周期天数
     * (针对1970年1月1日之后，求之前可以采用泰勒公式)
     * @param string $day1
     * @param string $day2
     * @return number
     */
    function diffBetweenTwoDays ($day1, $day2)
    {
        $second1 = strtotime($day1);
        $second2 = strtotime($day2);

        if ($second1 < $second2) {
            $tmp = $second2;
            $second2 = $second1;
            $second1 = $tmp;
        }
        return ($second1 - $second2) / 86400;
    }

}