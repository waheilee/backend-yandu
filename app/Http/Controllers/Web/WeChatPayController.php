<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Models\DepositOrder;
use App\Models\MemberDeposit;
use App\Models\project_check;
use App\Models\ProjectOrder;
use EasyWeChat\Factory;
use Illuminate\Http\Request;

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
            $order = ProjectOrder::where('order_no', $message['out_trade_no'])->first();

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

            ProjectOrder::where('id', $order->id)->update([
                'pay_status' => $order_status
            ]);


            # 押金记录
            $model = new MemberDeposit();
            $model->member_id = $order->merchant_id;
            $model->deposit_type = 1;
            $model->deposit = $order->money;
            $model->user_id = 0;
            $model->remark = '-';
            $model->save();

            # 财务记录
//            event(new FundCreated($order->member_id, Fund::DEPOSIT,'-', '+1000'));

            return true; // 返回处理完成
        });

        return $response;
    }

}