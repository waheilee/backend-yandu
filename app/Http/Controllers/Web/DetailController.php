<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Models\Merchant;
use App\Models\OrderLog;
use App\Models\ProjectMerchant;
use App\Models\Project;
use App\Models\ProjectOrder;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Web\WeChatPayController;

class DetailController extends Controller
{

    public function index($id)
    {
        $article = Project::whereId($id)->first();
        $user = \Auth::guard('admin')->user();
        if ($user){

            $userId = $user->id;
            return view('web.detail.index',compact('userId','article'));
        }else{
            return view('web.detail.index',compact('article'));
        }
    }

    /**
     * 获取商户信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMerchantInfo(Request $request)
    {
        $articleId  = $request->input('article_id');
        $merchantId = $request->input('merchant_id');
        $project    = Project::whereId($articleId)->first();
        if ($project->merchant_id == $merchantId){
            return response()->json(['code'=>422,'message'=>'改项目为您自己发布，不能成为该项目意向商户']);
        }else{
           $merchantModel = Merchant::whereId($merchantId)->first();
           $worker = $merchantModel->workers()->get();
           if ($worker->count() < $project->people_num){
               return response()->json(['code'=>422,'message'=>'施工人员小于项目要求最低施工人员数量']);
           }
           $data = $this->getData($merchantModel);
           $data['cash_deposit'] = exchangeToYuan($project->cash_deposit);
           $data['merchant_id']  = $merchantModel->id;
           $data['project_id']   = $project->id;
           return response()->json($data);
        }

    }

    public function getData($data)
    {
        $arr = [];
        $arr['code'] = 200;
        $arr['merchant_name'] = $data->company;
        $arr['worker']        = $this->getWorker($data->workers()->get());
        return $arr;
    }

    /**
     * 获取工人信息
     * @param $data
     * @return array
     */
    public function getWorker($data)
    {
        $arr = [];
        foreach ($data as $k){
           $arr[] =   "<div class=\"custom-control custom-control-alternative custom-checkbox col-xs-3 col-sm-2\">".
                      "<input class=\"custom-control-input\" name='worker[]' id=\" customCheck".$k->id."\" type=\"checkbox\" value='".$k->id."'>".
                      "<label class=\"custom-control-label\" for=\" customCheck".$k->id."\">".
                      "<span class=\"text-muted\">".$k->name."</span>".
                      "</label>".
                      "</div>";
        }
        return $arr;
    }


    /**
     * @param Request $request
     * @return string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function intention(Request $request)
    {
        $projectId   = $request->input('project_id');
        $merchantId  = $request->input('merchant_id');
        $cashDeposit = $request->input('cash_deposit');
        $worker      = $request->input('worker');
        $model       = ProjectMerchant::whereMerchantId($merchantId)->whereProjectId($projectId)->first();
        if ($model){
            return '已经是意向商户';
        }else{

            $orderId = $this->newOrderStore($projectId,$cashDeposit);
            $orderCode= $this->qr($orderId);
            return $orderCode;
        }
    }

    /**
     * 创建订单
     * @param $projectId
     * @param $cashDeposit
     * @return mixed
     */
    public function newOrderStore($projectId,$cashDeposit)
    {
        $count = ProjectOrder::where('member_id', \Auth::user()->id)->where('pay_status', 1)->count();
        if ($count > 0) {
            return '有未完成订单';
        }
        $model = new ProjectOrder();
        $model->merchant_id = \Auth::user()->id;
        $model->project_id  = $projectId;
        $model->money       = exchangeToFen($cashDeposit) ;
        $model->order_no    = date('YmdHis') . rand(1000, 9999);
        $model->channel     = 'WEB';
        $model->save();
        OrderLog::addLog($model->id, '意向商户押金', \Auth::user()->id);

        return $model->id;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function qr($id)
    {
        $app = new WeChatPayController();
        $order = ProjectOrder::find($id);
        $result = $app->weChatPay()->order->unify([
            'body' => '租赁支付',
            'out_trade_no' => $order->order_no,
            'total_fee' =>  exchangeToYuan($order->money),
            'notify_url' => url('api/notify/order/2'), // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'trade_type' => 'NATIVE', // 请对应换成你的支付方式对应的值类型
        ]);

        $qrCodePath = 'uploads/image/qrcode/order/' . $id . '.png';
        QrCode::format('png')->size(300)->generate($result['code_url'], public_path($qrCodePath));

        $data['qrcode'] = url($qrCodePath);
        $data['out_trade_no'] = $order->order_no;
        return $data;

    }
}