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
//        dd($dd);
//        $scan   = Pay::alipay($config)->scan($aliPayOrder);
//
//        if(empty($scan->code) || $scan->code !== '10000') return false;
//        $qrCodePath = 'uploads/image/qrcode/order/'. 'alipay' . $id . '.png';
//        QrCode::format('png')->size(300)->generate($scan->qr_code, public_path($qrCodePath));
//
//        $data['qrcode']       = url($qrCodePath);
//        $data['out_trade_no'] = $order->order_no;
//        return $data;
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
                $model->remark = '-';
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