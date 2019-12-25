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

    public function renewPay(Request $request)
    {
        $order = $request->input('order');
        $orderModel = new OrderMerchant();
        $orderModel->type            = BaseConstants::PRODUCT_TYPE_POLICY_EMPLOYER;//购买的商品类型为保险
        $orderModel->user_id         = \Auth::guard('admin')->user()->id;//付款用户id
        $orderModel->total_amount    = exchangeToFen(0.01) ;//订单金额
        $orderModel->order_num       = date('YmdHis') . rand(10000, 99999);//订单流水号
        $orderModel->channel         = 0;//支付渠道
        $orderModel->save();

        $model =  MemberPolicy::whereOrderNo($order)->first();
        $model->order_no       = $orderModel->order_num;//订单流水号
        $model->merchant_id    = \Auth::guard('admin')->user()->id;
        $model->update();
        return $orderModel->id;
    }
}