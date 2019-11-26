<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yansongda\Pay\Pay;
use App\Models\ProjectOrder;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class AlipayController extends Controller
{

    // 支付宝扫码 支付
    public function aliPayScan($id)
    {

        $order = ProjectOrder::find($id);
        $aliPayOrder = [
            'out_trade_no' => $order->order_no,
            'total_amount' => exchangeToYuan($order->money), // 支付金额
            'subject'      =>  '意向商户押金' // 备注
        ];

        $config = config('pay.alipay');
        $scan   = Pay::alipay($config)->scan($aliPayOrder);

        if(empty($scan->code) || $scan->code !== '10000') return false;
        $qrCodePath = 'uploads/image/qrcode/order/'. 'alipay' . $id . '.png';
        QrCode::format('png')->size(300)->generate($scan->qr_code, public_path($qrCodePath));

        $data['qrcode']       = url($qrCodePath);
        $data['out_trade_no'] = $order->order_no;
        return $data;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function notify(Request $request)
    {
        $alipay = Pay::alipay(config('pay.alipay'));

        try{
            $data = $alipay->verify(); // 是的，验签就这么简单！

            // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。
            // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号；
            // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）；
            // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）；
            // 4、验证app_id是否为该商户本身。
            // 5、其它业务逻辑情况

            \Log::debug('Alipay notify', $data->all());
        } catch (\Exception $e) {
            // $e->getMessage();
        }

        return $alipay->success()->send();// laravel 框架中请直接 `return $alipay->success()`
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Yansongda\Pay\Exceptions\GatewayException
     * @throws \Yansongda\Pay\Exceptions\InvalidArgumentException
     * @throws \Yansongda\Pay\Exceptions\InvalidConfigException
     * @throws \Yansongda\Pay\Exceptions\InvalidGatewayException
     * @throws \Yansongda\Pay\Exceptions\InvalidSignException
     */
    public function return(Request $request)
    {
        $alipay = Pay::alipay(config('pay.alipay'));

        return $alipay->driver('alipay')->gateway()->verify($request->all());
    }


}