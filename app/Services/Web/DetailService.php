<?php


namespace App\Services\Web;

use App\Constants\BaseConstants;
use App\Http\Controllers\Web\AlipayController;
use App\Models\ProjectDeposit;
use App\Models\ProjectOrder;
use App\Models\Worker;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Web\WeChatPayController;
use App\Models\Merchant;
use App\Models\OrderLog;
use App\Models\ProjectMerchant;
use App\Models\Project;
use Yansongda\Pay\Pay;

class DetailService
{

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
        $model       = ProjectOrder::whereMerchantId($merchantId)->whereProjectId($articleId)->wherePayStatus(1)->first();
        if ($model){
            return response()->json(['code'=>422,'message'=>'已经是意向商户']);
        }
        if ($project->merchant_id == $merchantId){
            return response()->json(['code'=>422,'message'=>'该项目为您自己发布，不能成为该项目意向商户']);
        }else{
            $merchantModel = Merchant::whereId($merchantId)->first();
            $worker = $merchantModel->workers()->get();
            if ($worker->count() < $project->people_num){
                return response()->json(['code'=>403,'message'=>'您商户下的施工人数小于该项目的用工最低人数']);
            }
            $data = $this->getData($merchantModel);
            $data['cash_deposit'] = exchangeToYuan($project->cash_deposit);
            $data['people']       = "（该项目最低施工人数要求：".$project->people_num."人）";
            $data['merchant_id']  = $merchantModel->id;
            $data['project_id']   = $project->id;
            $data['logo']         = $this->getLogo($merchantModel->logo);
            return response()->json($data);
        }

    }

    /**
     * 获取意向商户
     * @param $id
     * @return array|bool
     */
    public function getIntentionMerchant($id)
    {
        $inMerModel = ProjectOrder::whereProjectId($id)->wherePayStatus(1)->get();
        if (!$inMerModel){
            return false;
        }
        $data=[];
        foreach ($inMerModel as $item) {
            $deposit = ProjectDeposit::whereRelateOrder($item->order_no)->first();
            $i = [];
            $i['merchant_name'] = getMerchantName($item->merchant_id);
            $i['merchant_id']   = $item->merchant_id;
            $i['workers']       = $this->getWorkers(json_decode($item->worker_id));
            $i['status']       = $this->getButton($deposit->check_status);
            $data[] = $i;
        }

        return $data;
    }


    //获取意向商户在本项目中的施工人员
    public function getWorkers(array $id)
    {

        $data = [];
        foreach ($id as $item){
            $i =[];
            $workerModel      = Worker::whereId(intval($item))->first();
            $i['worker_name'] = $workerModel->name;
            $i['worker_id']   = $workerModel->id;
            $data[] =$i;
        }
        return $data;
    }

    public function getData($data)
    {
        $arr                  = [];
        $arr['code']          = 200;
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
            $arr[] = "<div class=\"col-md-3\">".
                        "<div class=\"custom-control custom-checkbox mb-3\">".
                            "<input class=\"custom-control-input\" name='worker[]' id=\"customCheck".$k->id."\" type=\"checkbox\" value='".$k->id."'>".
                            "<label class=\"custom-control-label\" for=\"customCheck".$k->id."\">".$k->name."</label>".
                        "</div>".
                     "</div>";
        }
        return $arr;
    }


    /**
     * 成为意向商户
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getIntention(Request $request)
    {
        $projectId   = $request->input('project_id');
        $merchantId  = $request->input('merchant_id');
        $cashDeposit = $request->input('cash_deposit');
        $worker      = $request->input('worker');
        $payType     = $request->input('pay_type');
        $project     = Project::whereId($projectId)->first();
        $model       = ProjectOrder::whereMerchantId($merchantId)->whereProjectId($projectId)->wherePayStatus(1)->first();
        if ($model){
            return response()->json(['message'=>'您已经是意向商户'],403);
        }
        if (empty($worker)){
            return response()->json(['message'=>'施工人元数量不能为空，请从新选择'],403);
        }
        if (count($worker) < $project->people_num){
            return response()->json(['message'=>'您提交施工人员小于项目最低要求，请从新选择'],403);
        }

        if ($payType == 'wechat'){
            $data = $this->wechatQrCode($projectId,$cashDeposit,$worker,$payType);
            return $data;
        }else{
            $data = $this->alipayQrCode($projectId,$cashDeposit,$worker,$payType);
            return $data;
        }

    }


    /**
     * @param $projectId
     * @param $cashDeposit
     * @param $worker
     * @param $type
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */

    public function wechatQrCode($projectId,$cashDeposit,$worker,$type)
    {
        $checkOrder = ProjectOrder::whereMerchantId( \Auth::guard('admin')->user()->id)
            ->whereProjectId($projectId)
            ->wherePayStatus(0)
            ->whereChannel($type)
            ->where('created_at','>',date('Y-m-d H:i:s',time()-60*60) )
            ->first();
        if ($checkOrder){
            $qrCodePath     = 'uploads/image/qrcode/order/'. 'wechat'. $checkOrder->id . '.png';
            $data['qrcode'] = url($qrCodePath);
            return $data;
        }
        $orderId  = $this->newOrderStore($projectId,$cashDeposit,$worker,$type);
        $orderCode= new WeChatPayController();
        $scan     = $orderCode->wechatScan($orderId);
        return $scan;
    }

    /**
     * @param $projectId
     * @param $cashDeposit
     * @param $worker
     * @param $type
     * @return int
     */
    public function alipayQrCode($projectId,$cashDeposit,$worker,$type)
    {
        $checkOrder = ProjectOrder::whereMerchantId( \Auth::guard('admin')->user()->id)
            ->whereProjectId($projectId)
            ->wherePayStatus(0)
            ->whereChannel($type)
            ->where('created_at','>',date('Y-m-d H:i:s',time()-60*60) )
            ->first();
//        if ($checkOrder){
//            $qrCodePath     = 'uploads/image/qrcode/order/'. 'alipay'. $checkOrder->id . '.png';
//            $data['qrcode'] = url($qrCodePath);
//            return $data;
//        }
        $orderId  = $this->newOrderStore($projectId,$cashDeposit,$worker,$type);
//        $orderCode= new AlipayController();
//        $scan     = $orderCode->aliPayScan($orderId);
        return $orderId;
    }

    /**
     * 创建订单
     * @param $projectId
     * @param $cashDeposit
     * @param $worker
     * @return int
     */
    public function newOrderStore($projectId,$cashDeposit,$worker,$type)
    {
        $model = new ProjectOrder();
        $model->merchant_id     = \Auth::guard('admin')->user()->id;
        $model->project_id      = $projectId;
        $model->money           = exchangeToFen($cashDeposit) ;
        $model->order_no        = date('YmdHis') . rand(10000, 99999);
        $model->channel         = $type;
        $model->refund_trade_no = 0;
        $model->pay_status      = 0;
        $model->worker_id       = json_encode($worker);
        $model->save();
        OrderLog::addLog($model->id, '意向商户押金', \Auth::guard('admin')->user()->id);
        return $model->id;
    }

    //商户头像
    public function getLogo($logo)
    {
        if (empty($logo)){
            return asset('assets/img/logo.jpeg');
        }else{
            return getAliOssUrl().$logo;
        }

    }

    public function getButton($status)
    {

        switch ($status) {
            case BaseConstants::ORDER_STATUS_INIT:
                $status = "<button class=\"btn btn-outline-info btn-sm m-r-5\" >待合作</button>";
                break;
            case BaseConstants::ORDER_STATUS_COOPERATION:
                $status = "<button type=\"button\" class=\"btn btn-outline-secondary btn-sm\" >合作中</button>";
                break;
            case BaseConstants::ORDER_STATUS_CLOSE:
                $status = "<button  class=\"btn btn-success btn-sm\">未合作</button>";
                break;
            case BaseConstants::ORDER_STATUS_CHECK:
                $status = "<button  class=\"btn btn-success btn-sm\">已提交验收报告</button>";
                break;
            case BaseConstants::ORDER_STATUS_WAIT_FOR_CHECK:
                $status = "<button  class=\"btn btn-success btn-sm\" >确认验收报告</button>";
                break;
            case BaseConstants::ORDER_STATUS_EVALUATE:
                $status = "<button  class=\"btn btn-success btn-sm\" >待评价</button>";

                break;
            case BaseConstants::ORDER_STATUS_DONE:
                $status = "<button  class=\"btn btn-secondary btn-sm\" disabled>项目已完成</button>";

                break;

        }
        return $status;

    }

}