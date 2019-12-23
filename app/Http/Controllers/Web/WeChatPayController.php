<?php

namespace App\Http\Controllers\Web;


use App\Constants\BaseConstants;
use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Controller;
use App\Models\OrderMerchant;
use App\Models\ProjectDeposit;
use App\Models\ProjectOrder;
use EasyWeChat\Factory;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class WeChatPayController extends Controller
{

    /**
     * 微信支付
     * @return \EasyWeChat\Payment\Application
     */
    public function weChatPay()
    {
        $config = [
            // 必要配置
            'app_id'             => env('WECHAT_PAYMENT_APPID'),
            'mch_id'             => env('WECHAT_PAYMENT_MCH_ID'),
            'key'                => env('WECHAT_PAYMENT_KEY'),   // API 密钥

            // 如需使用敏感接口（如退款、发送红包等）需要配置 API 证书路径(登录商户平台下载 API 证书)
            'cert_path'          => env('WECHAT_PAYMENT_CERT_PATH'), // XXX: 绝对路径！！！！
            'key_path'           => env('WECHAT_PAYMENT_KEY_PATH'),      // XXX: 绝对路径！！！！
//            'notify_url'         => '默认的订单回调地址',     // 你也可以在下单时单独设置来想覆盖它
        ];

        $app = Factory::payment($config);
        return $app;
    }
    /**
     * 小程序支付
     * @return \EasyWeChat\Payment\Application
     */
//    public function miniPay()
//    {
//        $config = [
//            // 必要配置
//            'app_id'             => env('WECHAT_PAYMENT_APPID'),
//            'mch_id'             => env('WECHAT_PAYMENT_MCH_ID'),
//            'key'                => env('WECHAT_PAYMENT_KEY'),   // API 密钥
//
//            // 如需使用敏感接口（如退款、发送红包等）需要配置 API 证书路径(登录商户平台下载 API 证书)
//            'cert_path'          => env('WECHAT_CERT_PATH'), // XXX: 绝对路径！！！！
//            'key_path'           => env('WECHAT_KEY_PATH'),      // XXX: 绝对路径！！！！
//
////            'notify_url'         => '默认的订单回调地址',     // 你也可以在下单时单独设置来想覆盖它
//        ];
//
//        $app = Factory::payment($config);
//        return $app;
//    }

    /**
     * 获取微信支付二维码
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function wechatScan($id)
    {
        $app = new WeChatPayController();
        $order = OrderMerchant::find($id);

        $result = $app->weChatPay()->order->unify([
            'body' => BaseConstants::PRODUCT_TYPE_MAP[$order->type],
            'out_trade_no' => $order->order_num,
            'total_fee' =>  $order->total_amount,
            'notify_url' => url('api/notify/order/2'), // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'trade_type' => 'NATIVE', // 请对应换成你的支付方式对应的值类型
        ]);
        $qrCodePath = 'uploads/image/qrcode/order/'.'wechat'. $id . '.png';
        QrCode::format('png')->size(300)->generate($result['code_url'], public_path($qrCodePath));
        $data['qrcode'] = url($qrCodePath);
        $data['out_trade_no'] = $order->order_num;
        return $data;
    }

    /**
     * 押金通知
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Kernel\Exceptions\Exception
     */
    public function deposit(Request $request, $id)
    {

        $app = $this->weChatPay();

        $response = $app->handlePaidNotify(function($message, $fail){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            $order = OrderMerchant::whereOrderNum( $message['out_trade_no'])->first();
            if (!$order) { // 如果订单不存在 或者 订单已经支付过了
                return true; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            ///////////// <- 建议在这里调用微信的【订单查询】接口查一下该笔订单的情况，确认是已经支付 /////////////
            $pay_status = 0;
            if ($message['return_code'] === 'SUCCESS') { // return_code 表示通信状态，不代表支付状态
                // 用户是否支付成功
                if (array_get($message, 'result_code') === 'SUCCESS') {
                    $pay_status = 1;

                    // 用户支付失败
                } elseif (array_get($message, 'result_code') === 'FAIL') {
                    $pay_status = 2;
                }
            } else {
                return $fail('通信失败，请稍后再通知我');
            }
                OrderMerchant::whereId($order->id)->update([
                    'pay_status' => $pay_status,
                    'pay_time'=>date('Y-m-d h:i:s',time())
            ]);
            if ($order->type === BaseConstants::PRODUCT_TYPE_PROJECT){
                $projectModel = ProjectOrder::whereOrderNo($order)->first();
                $projectModel->update(['status'=>1]);
            }
            # 财务记录
//            event(new FundCreated($order->member_id, Fund::DEPOSIT,'-', '+1000'));
            \Log::debug('WeChat notify success', $message);
            return true; // 返回处理完成
        });

        return $response;
    }

    /**
     * @param $orderNum
     * @return bool
     */
    public function refund($orderNum)
    {
        $refundOrder = date('YmdHis') . rand(10000, 99999);
        try{
            $order = ProjectOrder::whereOrderNo($orderNum)->first();
            $orderDep = ProjectDeposit::whereRelateOrder($orderNum)->first();
            if (!$order) {
                throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "查无此订单");
            }
            $app = $this->weChatPay();
            $result = $app->refund->byOutTradeNumber($order->order_no, $refundOrder, $order->money, $order->money, [
                // 可在此处传入其他参数，详细参数见微信支付文档
                'refund_desc' => '项目押金退回',
            ]);
            if ($result['return_code'] === 'SUCCESS') { // return_code 表示通信状态，不代表支付状态
                // 用户是否支付成功
                if (array_get($result, 'result_code') === 'SUCCESS') {
                    $order->refund_trade_no = $refundOrder;
                    $order->update();
                    $orderDep->deposit_type = 2;//将项目修改为已退款
                    $orderDep->update();
                    // 用户支付失败
                } elseif (array_get($result, 'result_code') === 'FAIL') {
                    $this->refund($order->order_no);//
                }
            } else {
                $this->refund($order->order_no);//
            }
            return true;
        }catch (\Exception $exception){
            throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "退款失败！");
        }

    }

    /**
     * @param Request $request
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function queryRefund(Request $request)
    {
        $order = $request->input('order');
        $app = $this->weChatPay();
        $result = $app->refund->queryByOutTradeNumber($order);
        if ($result['return_code'] === 'SUCCESS'){
            $data['refund_type'] = "微信退款" ;
            $data['refund_fee'] = exchangeToYuan($result['refund_fee']).'元' ;
            $data['refund_status'] = $this->refundStatus($result['refund_status_0']) ;//退款转态
            $data['refund_success_time'] = $result['refund_success_time_0'];
            return $data;
        }else{

            return $result;
        }
//        return $result;
    }
    public function notifyOrder($type,$order)
    {
        if ($type === 1){
            $projectModel = ProjectOrder::whereOrderNo($order)->first();
            $projectModel->update(['status'=>1]);
        }
        return true;
    }

    public function refundStatus($status)
    {
        switch ($status){
            case 'SUCCESS':
                $status = '退款成功';
                break;
            case 'REFUNDCLOSE':
                $status = '退款关闭';
                break;
            case 'PROCESSING':
                $status = '退款处理中';
                break;
            case 'CHANGE':
                $status = '退款异常';
                break;
        }
        return $status;
    }

}