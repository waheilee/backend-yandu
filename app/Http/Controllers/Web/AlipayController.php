<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectDeposit;
use Illuminate\Http\Request;
use Yansongda\Pay\Pay;
use App\Models\ProjectOrder;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class AlipayController extends Controller
{



    // 支付宝网页支付
    public function aliPay($id)
    {

        $order = ProjectOrder::find($id);
        $project = Project::whereId($order->project_id)->first();
        $aliPayOrder = [
            'out_trade_no' => $order->order_no,
            'total_amount' => exchangeToYuan($order->money), // 支付金额
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
            $data = $alipay->verify(); // 是的，验签就这么简单！
            $order = ProjectOrder::whereOrderNo( $data->out_trade_no)->first();
            if (!$order) { // 如果订单不存在 或者 订单已经支付过了
                return true; // 告诉支付宝，我已经处理完了，订单没找到，别再通知我了
            }
            if ($order->pay_status === 1){
                return true;
            }
            if ($data->trade_status === 'TRADE_SUCCESS'){
                $order_status = 1;
                if ($data->app_id != env('ALI_APP_ID')){
                    return false;
                }
                if (exchangeToFen($data->total_amount) != $order->money ){
                    return false;
                }
                ProjectOrder::whereId( $order->id)->update([
                    'pay_status' => $order_status
                ]);
                $userModel = Project::whereId($order->project_id)->first();

                # 押金记录
                $model = new ProjectDeposit();
                $model->merchant_id = $order->merchant_id;
                $model->project_id = $order->project_id;
                $model->pr_mer_id = $userModel->merchant_id;
                $model->deposit_type = 1;
                $model->deposit = $order->money;
                $model->relate_order_id = $order->id;
                $model->relate_order = $order->order_no;
                $model->remark = 'alipay';
                $model->save();
                \Log::debug('Alipay notify success', $data->all());
            }else{
                return false;
            }

        } catch (\Exception $e) {
            throw new $e;
            // $e->getMessage();
        }

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
        $alipay = Pay::alipay(config('pay.alipay'))->verify();
        $projectOrder = ProjectDeposit::whereRelateOrder($alipay->out_trade_no)->first();
        return redirect('detail/'.$projectOrder->project_id);
    }


//    public function alipayRefund($orderNum)
//    {
//        $alipay = Pay::alipay(config('pay.alipay'));
//        $orderDep = ProjectDeposit::whereRelateOrder($orderNum)->first();
//        $order = ProjectOrder::whereOrderNo($orderNum)->first();
//
//        $orders = [
//            'out_trade_no' => $orderDep->relate_order,
//            'refund_amount' => exchangeToYuan($orderDep->deposit),
//        ];
//
//        $result = $alipay->refund($orders);
//        if ($result['code'] === 10000) {
//            if ($result['msg'] === 'Success') {
//                $order->refund_trade_no = $result['trade_no'];
//                $order->update();
//                $orderDep->deposit_type = 2;//将项目修改为已退款
//                $orderDep->update();
//
//            } elseif ($result['code'] === 20000) {
//                $this->alipayRefund($order->order_no);//
//            }
//            \Log::debug('Alipay refund', $result->all());
//
//        }
//        return true;
//    }

    // 支付宝退款
    /**
     * @param $orderNum
     * @return bool
     */
    public function aliPayRefund($orderNum)
    {
        $orderDep = ProjectDeposit::whereRelateOrder($orderNum)->first();
        $order = ProjectOrder::whereOrderNo($orderNum)->first();
        try {
            $payOrder = [
                'out_trade_no' => $orderDep->relate_order, // 商家订单号
                'refund_amount' => exchangeToYuan($orderDep->deposit), // 退款金额  不得超过该订单总金额
                //'out_request_no' => Common::getUuid() // 同一笔交易多次退款标识（部分退款标识）
            ];

            // 返回状态码 code 10000 成功
            $result = Pay::alipay(config('pay.alipay'))->refund($payOrder);
            if (empty($result->code) || $result->code !== '10000') throw new \Exception('请求支付宝退款接口失败');
            // 订单改为 已退款状态
            $order->refund_trade_no = $result['trade_no'];
            $order->update();
            $orderDep->deposit_type = 2;//将项目修改为已退款
            $orderDep->update();
            return true;
            // ~~自己商城的订单状态修改逻辑
        } catch (\Exception $exception) {
            \Log::error('Alipay refund',$exception->getMessage());
            return false;
        }
    }

}