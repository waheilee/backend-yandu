<?php

namespace App\Http\Controllers\Admin\SeNewAdmin;


use App\Http\Controllers\Controller;
use App\Models\MemberPolicy;
use App\Models\Merchant;
use App\Services\SeNew\WorkerService;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    protected $workerService;

    public function __construct(WorkerService $workerService)
    {
        $this->workerService = $workerService;
    }

    public function index()
    {
        $memberPolicyModel = MemberPolicy::whereChannel('senew')->get();
        foreach ($memberPolicyModel as $item){
            if (!empty($item->out_time)){
                if (strtotime($item->out_time) < time()){
                    $item->status = 3;
                    $item->update();
                }
            }
        }
        $total = Merchant::whereId(\Auth::id())->first()->policy_num;
        $use = $memberPolicyModel->sum('number');
        $surplus = $total - $use;
        return view('se_new.index.index',compact('total','use','surplus'));
    }

    public function indexRequest(Request $request)
    {
        $data =$this->workerService->indexAjax($request);
        return $data;
    }

    public function policy(Request $request)
    {
        $data =$this->workerService->workerPolicy($request);
        return $data;
    }
}