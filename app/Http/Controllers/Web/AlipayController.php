<?php

namespace App\Http\Controllers\Web;


use App\Constants\BaseConstants;
use App\Http\Controllers\Controller;
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
        $projectOrder = ProjectOrder::whereOrderNo($order->order_num)->first();
        $project = Project::whereId($projectOrder->project_id)->first();

        $aliPayOrder = [
            'out_trade_no' => $order->order_num,
            'total_amount' => exchangeToYuan($order->total_amount), // 支付金额
            'subject'      =>  '《'.substr($project->project_name,0,30).'...》的意向商户押金', // 备注
            'http_method'  => 'GET'
        ];

        $config = config('pay.alipay');

        return  Pay::alipay($config)->web($aliPayOrder);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function alipayNotify(Request $request)
    {
        $alipay = Pay::alipay(config('pay.alipay'));
        try{
            $data = $alipay->verify();
            $order = OrderMerchant::whereOrderNum($data->out_trade_no)->first();
            $projectOrder = ProjectOrder::whereOrderNo($order->order_num)->first();
                $order->update([
                    'pay_status' => 1
                ]);
//                $this->notifyOrder($order->type,$order->order_num);
                \Log::debug('Alipay notify success', $data->all());
        } catch (\Exception $e) {
            throw new $e;
            // $e->getMessage();
        }
        $alipay->success();
        return redirect('detail/'.$projectOrder->project_id);// laravel 框架中请直接 `return $alipay->success()`
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
        $projectOrder = ProjectOrder::whereOrderNo($order->order_num)->first();

        return redirect('detail/'.$projectOrder->project_id);
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
        return true;
    }

}