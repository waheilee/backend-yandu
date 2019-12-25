<?php

namespace App\Http\Controllers\Web;


use App\Constants\BaseConstants;
use App\Http\Controllers\Controller;
use App\Models\MemberPolicy;
use App\Models\OrderMerchant;
use App\Models\Project;
use App\Models\ProjectDeposit;
use Illuminate\Http\Request;
use Yansongda\Pay\Pay;
use App\Models\ProjectOrder;
class AlipayController extends Controller
{



    // 支付宝网页支付
    public function aliPay($id)
    {
        $order = OrderMerchant::find($id);
        $subject = null;
        if ($order->type ==1){
            $projectOrder = ProjectOrder::whereOrderNo($order->order_num)->first();
            $project = Project::whereId($projectOrder->project_id)->first();
            $subject = '《'.substr($project->project_name,0,30).'...》的意向商户押金';
        }
        if ($order->type ==2){
            $subject = '购买雇主责任险';
        }

        $aliPayOrder = [
            'out_trade_no' => $order->order_num,
            'total_amount' => exchangeToYuan($order->total_amount), // 支付金额
            'subject'      =>  $subject, // 备注
            'http_method'  => 'GET'
        ];

        $config = config('pay.alipay');

        return  Pay::alipay($config)->web($aliPayOrder);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Yansongda\Pay\Exceptions\InvalidConfigException
     * @throws \Yansongda\Pay\Exceptions\InvalidSignException
     */
    public function alipayNotify(Request $request)
    {
        $alipay = Pay::alipay(config('pay.alipay'));
        $data = $alipay->verify();
        $order = OrderMerchant::whereOrderNum($data->out_trade_no)->first();
        $order->pay_order_num = $data->trade_no;
        $order->pay_time      = date('Y-m-d h:i:s',time());
        $order->pay_status    = 1;
        $order->update();

        $this->notifyOrder($order->type,$order->order_num);
        \Log::debug('Alipay notify success', $data->all());
        return $alipay->success();// laravel 框架中请直接 `return $alipay->success()`
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Yansongda\Pay\Exceptions\InvalidConfigException
     * @throws \Yansongda\Pay\Exceptions\InvalidSignException
     */
    public function alipayReturn(Request $request)
    {
        $alipay       = Pay::alipay(config('pay.alipay'))->verify();
        $order        = OrderMerchant::whereOrderNum($alipay->out_trade_no)->first();
        if ($order->type == 1){
            $projectOrder = ProjectOrder::whereOrderNo($order->order_num)->first();
            return redirect('detail/'.$projectOrder->project_id);
        }else{
            return redirect('admin/policies/employer/index');
        }

    }


    // 支付宝退款
    /**
     * @param $orderNum
     * @return bool
     */
    public function aliPayRefund($orderNum)
    {
        $order   = OrderMerchant::whereOrderNum($orderNum)->first();
        $project = ProjectOrder::whereOrderNo($orderNum)->first();
        try {
            $payOrder = [
                'out_trade_no' => $order->order_num, // 商家订单号
                'refund_amount' => exchangeToYuan($order->total_amount), // 退款金额  不得超过该订单总金额
                //'out_request_no' => Common::getUuid() // 同一笔交易多次退款标识（部分退款标识）
            ];

            // 返回状态码 code 10000 成功
            $result = Pay::alipay(config('pay.alipay'))->refund($payOrder);
            if (empty($result->code) || $result->code !== '10000') throw new \Exception('请求支付宝退款接口失败');
            // 订单改为 已退款状态
            $order->refund_trade_no = $result['trade_no'];
            $order->refund_time     = date('Y-m-d h:i:s',time());
            $order->refund_status   = 1;
            if ($order->type == BaseConstants::PRODUCT_TYPE_PROJECT){
                $project->remark = '已退款';
                $project->update();
            }
            $order->update();

            return true;
            // ~~自己商城的订单状态修改逻辑
        } catch (\Exception $exception) {
            \Log::error('Alipay refund',$exception->getMessage());
            return false;
        }
    }

    /**
     * @param Request $request
     * @return \Yansongda\Supports\Collection
     * @throws \Yansongda\Pay\Exceptions\GatewayException
     * @throws \Yansongda\Pay\Exceptions\InvalidConfigException
     * @throws \Yansongda\Pay\Exceptions\InvalidSignException
     */
    public function queryRefund(Request $request)
    {
        $order = $request->input('order');
        $orders = [
            'out_trade_no' => $order,
            'out_request_no' => $order
        ];
        $projectOrder = ProjectOrder::whereOrderNo($order)->first();
//        dd($projectOrder);
        $result = Pay::alipay(config('pay.alipay'))->find($orders, 'refund');
        if ($result['code'] === "10000"){
            $data['refund_type'] = "支付宝退款";
            $data['refund_amount'] = $result['refund_amount']."元";
            $data['refund_status'] = '退款成功';
            $data['refund_success_time'] = date("Y-m-d H:i:s",strtotime($projectOrder->updated_at)); ;
            return $data;
        }else{
            $data['refund_status'] = '退款异常';
            return $data;
        }
//        return $result;

    }

    public function notifyOrder($type,$order)
    {
        if ($type == 1){
            $projectModel = ProjectOrder::whereOrderNo($order)->first();
            $projectModel->status = 1;
            $projectModel->update();
        }
        if ($type == 2){
            $policyModel = MemberPolicy::whereOrderNo($order)->first();
            $policyModel->effective_date = null;
            $policyModel->out_time       = null;
            $policyModel->update();
        }
        return true;
    }

}