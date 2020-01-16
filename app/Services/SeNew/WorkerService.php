<?php

namespace App\Services\SeNew;


use App\Constants\BaseConstants;
use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Models\MemberPolicy;
use App\Models\Merchant;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use Ofcold\IdentityCard\IdentityCard;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class WorkerService
{

    public function indexAjax(Request $request)
    {
        $limit   = $request->input('limit');
        $worker = Worker::whereMerchantId(\Auth::user()->id)->whereChannel('senew')->paginate($limit);
        foreach ($worker as $item) {
            $policy = MemberPolicy::whereOrderNo($item['policy_order_num'])->first();
            $policyNo = '';
            $policyTime = '';
            $status = $this->status($policy['status'],$item['id']);
            $renewal = '';

            if ($policy){
                $outTime = empty($policy->out_time) ? '':date('Y-m-d',strtotime($policy->out_time));

                $img = json_encode($policy->policy_img);
                $policyNo = "<a href='#' onclick='policy_image($img)' > $policy->policy_no</a>";
                $policyTime = $policy->effective_date.'至'.$outTime;
                $renewal = MemberPolicy::whereIdcard($item['card_num'])->whereChannel('senew')->count();
            }
            $item['policy_no'] = $policyNo;
            $item['effective_time'] = $policyTime;
            $item['status'] = $status['status'];
            $item['renewal'] = $renewal;

//            $qrcode = $this->workerQrcode($item['qrcode'],$item['id']);
//            $item['address'] = $item['province'].'.'.$item['city'].'.'.$item['county'];
//            $item['tec']     = $this->getTec($item['tec']);
//            $item['sex']     = $this->getSex($item['sex']);
//            $item['qrcode']  = " <a onclick=\"image($item->id)\"><img src=\"".asset($qrcode)."\" style='width: 50px' ></a>";
        }
        $array['page'] = $worker->currentPage();
        $array['rows'] = $worker->items();
        $array['total'] = $worker->total();
        return $array;
    }

    public function workerPolicy(Request $request)
    {
        $number = $request->input('number');
        $policyCount =     MemberPolicy::whereMerchantId(\Auth::id())->whereChannel('senew')->sum('number');
        $merchantModel = Merchant::whereId(\Auth::id())->first();
        if (($number + $policyCount) >= $merchantModel->policy_num){
            return response()->json(['message'=>'保单数量不足'],422);
        }
        try{
            \DB::beginTransaction();

            $workerModel = Worker::whereId($request->input('worker_id'))->first();
            $model = new MemberPolicy();
            $model->order_no    = date('YmdHis') . rand(10000, 99999);//订单流水号
            $model->merchant_id = \Auth::guard('admin')->user()->id;
            $model->username    = $workerModel->name;
            $model->phone       = $workerModel->phone;
            $model->idcard      = $workerModel->card_num;
            $model->email       = $workerModel->email;
            $model->position    = $workerModel->province;
            $model->policy_type = BaseConstants::POLICY_TYPE_EMPLOYER;//雇主责任险
            $model->status      = 1;
            $model->policy_id   = 0;
            $model->renewal_times =1;
            $model->number = $request->input('number');
            $model->channel = 'senew';
            $model->save();
            $workerModel->policy_order_num =  $model->order_no;
            $workerModel->update();

            \DB::commit();
            return response()->json(['新增保单成功']);

        }catch (\Exception $e){
            \DB::rollBack();
            throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "保单新建失败失败!");
        }

    }

    public function getStore(Request $request)
    {
        $cardNum = $request->input('card_num');
        $card = IdentityCard::make($cardNum);
        if ($card === false) {
            return response()->json(['message'=>'身份证证件号码不正确'],403);
        }else{
            $workerModel = new Worker();
            $workerModel->card_a    = $request->input('card_as');
            $workerModel->card_b    = $request->input('card_bs');
            $workerModel->card_num  = $request->input('card_num');
            $workerModel->name      = $request->input('name');
            $workerModel->age       = $request->input('age');
            $workerModel->sex       = $request->input('sex');//1男2女3保密
            $workerModel->phone     = $request->input('phone');
            $workerModel->email     = $request->input('email');
            $workerModel->province  = $request->input('s_province');
            $workerModel->city      = $request->input('s_city');
            $workerModel->county    = $request->input('s_county');
            $workerModel->tec       = $request->input('tec');//1贴瓷砖2除甲醛3保洁4瓦工5油工6水暖工
            $workerModel->work_age  = $request->input('work_age');
            $workerModel->tec_text  = $request->input('tec_text');
            $workerModel->merchant_id  = \Auth::user()->id;
            $workerModel->save();

            return response()->json(['message' => '信息提交成功',]);

        }
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request)
    {

        $file = $request->file('imagefile');
        $imgId = $request->input('img_id');
        //验证文件
        if($file->isValid()){
            $extension = $file->getMimeType(); //上传文件的后缀.
            $ext = substr($extension,6,10);
            $filename = $file->getClientOriginalName();
            //验证后缀
            $allow_ext = ['jpg', 'png', 'jpeg', 'gif'];
            if(!in_array(strtolower($ext), $allow_ext)){
                $result['msg'] = '文件格式不正确!';
                return response()->json($result);
            }

            $image = $file->store('images');
            $filepath = Storage::url($image);
            $result['status'] = 200;
            $result[0]['path'] = $filepath;
            $result['msg'] = '上传成功!';
            $result['img_id'] = $imgId.'s';
            $result['data'] = [
                'filename' => explode('.', $filename)[0],
                'img' => $image,
            ];
        }

        //返回响应
        return response()->json($result);
    }

    public function getTec($tec)
    {
        switch ($tec) {
            case 1:
                $tec = "<span class=\"badge badge-default\">贴瓷砖</span>";
                break;
            case 2:
                $tec = " <span class=\"badge badge-primary\">除甲醛</span>";
                break;
            case 3:
                $tec = " <span class=\"badge badge-info\">保洁</span>";
                break;
            case 4:
                $tec = " <span class=\"badge badge-success\">瓦工</span>";
                break;
            case 5:
                $tec = " <span class=\"badge badge-danger\">油工</span>";
                break;
            case 6:
                $tec = " <span class=\"badge badge-warning\">水暖工</span>";
                break;
        }
        return $tec;
    }

    public function getSex($sex)
    {
        switch ($sex){
            case 1:
                $sex = '男';
                break;
            case 2:
                $sex = '女';
                break;
        }
        return $sex;
    }

    public function workerQrcode($qrcode,$id)
    {
        if (!$qrcode){
            $url = env('APP_URL').'/m/worker/info/index?worker_id='.$id;
            $qrCodePath = 'uploads/image/qrcode/worker/'.'worker'. $id . '.png';
            QrCode::format('png')->size(500)->generate($url,$qrCodePath);
            $workerModel = Worker::whereId($id)->first();
            $workerModel->qrcode = $qrCodePath;
            $workerModel->update();
            return $workerModel->qrcode;
        }
        return $qrcode;
    }

    public function status($payStatus,$workerId)
    {
        $data = [];
        if ($payStatus === null){
            $data['status'] = "<button class='tag badge badge-secondary' onclick='policy($workerId)'>点击进行投保</button>";
            return $data;
        }
        switch ($payStatus){
            case 0:
                $data['status'] = "<button class='tag badge badge-secondary'>未付款</button>";
                break;
            case 1:
                $data['status'] = "<button class='tag badge badge-info'>暂未生效</button>";
                break;
            case 2:
                $data['status'] = "<button class='tag badge badge-success'>有效保单</button>";
                break;
            case 3:
                $data['status'] = "<button class='tag badge badge-warning' onclick='policy($workerId)'>已过期(点击投保)</button>";
                break;
            case 4:
                $data['status'] = "<button class='tag badge badge-danger'>失效保单</button>";
                break;

        }
        return $data;
    }
}