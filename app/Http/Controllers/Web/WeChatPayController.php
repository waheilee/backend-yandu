<?php

namespace App\Http\Controllers\Web;


use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\project_check;
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
    public function miniPay()
    {
        $config = [
            // 必要配置
            'app_id'             => env('WECHAT_PAYMENT_APPID'),
            'mch_id'             => env('WECHAT_PAYMENT_MCH_ID'),
            'key'                => env('WECHAT_PAYMENT_KEY'),   // API 密钥

            // 如需使用敏感接口（如退款、发送红包等）需要配置 API 证书路径(登录商户平台下载 API 证书)
            'cert_path'          => env('WECHAT_CERT_PATH'), // XXX: 绝对路径！！！！
            'key_path'           => env('WECHAT_KEY_PATH'),      // XXX: 绝对路径！！！！

//            'notify_url'         => '默认的订单回调地址',     // 你也可以在下单时单独设置来想覆盖它
        ];

        $app = Factory::payment($config);
        return $app;
    }

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
        $order = ProjectOrder::find($id);
        $result = $app->weChatPay()->order->unify([
            'body' => '缴纳项目保证金',
            'out_trade_no' => $order->order_no,
            'total_fee' =>  $order->money,
            'notify_url' => url('api/notify/order/2'), // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'trade_type' => 'NATIVE', // 请对应换成你的支付方式对应的值类型
        ]);

        $qrCodePath = 'uploads/image/qrcode/order/'.'wechat'. $id . '.png';
        QrCode::format('png')->size(300)->generate($result['code_url'], public_path($qrCodePath));

        $data['qrcode'] = url($qrCodePath);
        $data['out_trade_no'] = $order->order_no;
        return $data;
    }

    /**
     * 押金通知
     * @param Request $request
     * @param $id integer 1为web，2为小程序
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Kernel\Exceptions\Exception
     */
    public function deposit(Request $request, $id)
    {
        if ($id == 1) {
            $app = $this->miniPay();
        } else {
            $app = $this->weChatPay();
        }

        $response = $app->handlePaidNotify(function($message, $fail){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            $order = ProjectOrder::whereOrderNo( $message['out_trade_no'])->first();
            if (!$order) { // 如果订单不存在 或者 订单已经支付过了
                return true; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }

            ///////////// <- 建议在这里调用微信的【订单查询】接口查一下该笔订单的情况，确认是已经支付 /////////////
            $order_status = 0;
            if ($message['return_code'] === 'SUCCESS') { // return_code 表示通信状态，不代表支付状态
                // 用户是否支付成功
                if (array_get($message, 'result_code') === 'SUCCESS') {
                    $order_status = 1;

                    // 用户支付失败
                } elseif (array_get($message, 'result_code') === 'FAIL') {
                    $order_status = 2;
                }
            } else {
                return $fail('通信失败，请稍后再通知我');
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
            $model->remark = 'wechat';
            $model->save();

            # 财务记录
//            event(new FundCreated($order->member_id, Fund::DEPOSIT,'-', '+1000'));

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
                    $orderDep->deposit_type;
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
     * @param $refundOrder
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function queryRefund($refundOrder)
    {
        $app = $this->weChatPay();
        $result = $app->refund->queryByOutRefundNumber($refundOrder);
        return $result;
    }

}