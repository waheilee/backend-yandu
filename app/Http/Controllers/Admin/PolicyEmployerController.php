<?php

namespace App\Http\Controllers\Admin;


use App\Constants\BaseConstants;
use App\Http\Controllers\Controller;
use App\Models\MemberPolicy;
use App\Models\OrderMerchant;
use App\Services\Admin\PolicyEmployerService;
use Illuminate\Http\Request;

class PolicyEmployerController extends Controller
{

    protected $policyEmployerService;


    public function __construct(PolicyEmployerService $policyEmployerService)
    {
        $this->policyEmployerService = $policyEmployerService;
    }

    public function index()
    {
       return view('admin.policy.employer.index');
    }

    public function indexRequest(Request $request)
    {
        $data =$this->policyEmployerService->indexAjax($request);
        return $data;
    }

    public function goPay(Request $request)
    {
        $order = $request->input('order');
        $orderModel = OrderMerchant::whereOrderNum($order)->first();
        return $orderModel->id;
    }

    public function rePay(Request $request)
    {
        $order = $request->input('order');
        $orderModel =  MemberPolicy::whereOrderNo($order)->first();
        return $orderModel;
    }
}