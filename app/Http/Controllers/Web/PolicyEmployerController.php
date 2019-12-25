<?php

namespace App\Http\Controllers\Web;


use App\Constants\BaseConstants;
use App\Http\Controllers\Controller;
use App\Models\MemberPolicy;
use App\Models\OrderMerchant;
use App\Requests\Web\PolicyEmployerRequest;
use Illuminate\Http\Request;

class PolicyEmployerController extends Controller
{

    public function index()
    {
        $user = \Auth::guard('admin')->user();
        if ($user){
            $userId = $user->id;
            return view('web.policy.employer',compact('userId'));
        }
        return view('web.policy.employer');
    }

    public function store(PolicyEmployerRequest $request)
    {
        //创建新订单
        $orderModel = new OrderMerchant();
        $orderModel->type            = BaseConstants::PRODUCT_TYPE_POLICY_EMPLOYER;//购买的商品类型为保险
        $orderModel->user_id         = \Auth::guard('admin')->user()->id;//付款用户id
        $orderModel->total_amount    = exchangeToFen(0.01) ;//订单金额
        $orderModel->order_num       = date('YmdHis') . rand(10000, 99999);//订单流水号
        $orderModel->channel         = 0;//支付渠道
        $orderModel->save();

        $model = new MemberPolicy();
        $model->order_no    = $orderModel->order_num;//订单流水号
        $model->merchant_id = \Auth::guard('admin')->user()->id;
        $model->username    = $request->input('name');
        $model->phone       = $request->input('phone');
        $model->idcard      = $request->input('idcard');
        $model->email       = $request->input('email');
        $model->position    = $request->input('position');
        $model->policy_type = BaseConstants::POLICY_TYPE_AIR;//空气治理责任险
        $model->policy_id   = 0;
        $model->save();
        return $orderModel->id;
    }

    public function pay($id)
    {
        $orderModel = OrderMerchant::whereId($id)->first();
        if ($orderModel->pay_status == 1){
            return "该笔订单已支付过";
        }
        $policy = MemberPolicy::whereOrderNo($orderModel->order_num)->first();
        return view('web.policy.employer_pay',compact('orderModel','policy'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function wechatPay(Request $request)
    {
        $wechat = new WeChatPayController();
        $data = $wechat->wechatScan($request->input('order_id'));
        return $data;

    }


}