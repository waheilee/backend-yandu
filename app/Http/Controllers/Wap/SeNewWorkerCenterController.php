<?php

namespace App\Http\Controllers\Wap;


use App\Constants\BaseConstants;
use App\Models\MemberPolicy;
use App\Models\Worker;
use App\Models\WorkerEvaluate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Ofcold\IdentityCard\IdentityCard;

class SeNewWorkerCenterController
{

    public function index()
    {
        if (\Auth::user()->is_active == 0){
            return redirect(url('m/se_new/worker/edit/'.\Auth::id()));
        }
        $worker = Worker::whereId(\Auth::id())->first();
        $worker->tec = BaseConstants::WORKER_OCCUPATION_MAP[$worker->tec];
        $evaluate = WorkerEvaluate::where('evaluate_id_b',$worker->id)->paginate(6);
        $points = WorkerEvaluate::where('evaluate_id_b',$worker->id)->sum('point');
        $count  = WorkerEvaluate::where('evaluate_id_b',$worker->id)->count();
        if ($count != 0){
            $point  = round($points/$count,2);
        }else{
            $point  = 0;
        }
        $memberPolicy = MemberPolicy::whereOrderNo($worker->policy_order_num)->first();
        if (empty($memberPolicy->effective_date)){
            $policyTime = '暂无保险';
        }else{
            $outTime = empty($memberPolicy->out_time) ? '':date('Y-m-d',strtotime($memberPolicy->out_time));
            $policyTime = $memberPolicy->effective_date.'至'.$outTime;
        }

        return view('wap.se_new.worker_center.index',compact('worker','evaluate','point','count','policyTime'));
    }

    public function edit($id)
    {
        $workerModel = Worker::whereId($id)->first();
        return view('wap.se_new.worker_center.worker_edit',compact('workerModel'));
    }

    public function update(Request $request)
    {

        $idCard      = $request->input('id_card');
        $card = IdentityCard::make($idCard);
        if ($card === false) {
            return response()->json(['errors' =>['idcard'=>[0=>'证件号码不正确']]], 422);
        }
        $name        = $request->input('name');
        $phone       = $request->input('phone');
        $age         = $request->input('age');
        $sex         = $request->input('sex');
        $occupation  = $request->input('occupation');
        $workingLife = $request->input('working_life');
        $content     = $request->input('content');
        $idCardA     = $request->file('id_card_a');
        $idCardB     = $request->file('id_card_b');
        $id          = $request->input('id');
//        dd($request->all());
        $workModel = Worker::whereId($id)->first();
        $workModel->card_num  = $idCard;
        $workModel->name      = $name;
        $workModel->phone     = $phone;
        $workModel->age       = $age;
        $workModel->sex       = $sex;
        $workModel->tec       = $occupation;
        $workModel->work_age  = $workingLife;
        $workModel->tec_text  = $content;
        $workModel->card_a    = $this->handle($idCardA,$workModel->card_a);
        $workModel->card_b    = $this->handle($idCardB,$workModel->card_b);
        $workModel->is_active = 1;
        $workModel->save();
        return response()->json(['修改成功']);

    }

    /**
     * @param $carImg
     * @param $work
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle($carImg,$work)
    {
        if (!empty($carImg)){
            //验证文件
            if($carImg->isValid()){
                $extension = $carImg->getMimeType(); //上传文件的后缀.
                $ext = substr($extension,6,10);
                $filename = $carImg->getClientOriginalName();
                //验证后缀
                $allow_ext = ['jpg', 'png', 'jpeg', 'gif'];
                if(!in_array(strtolower($ext), $allow_ext)){
                    $result['msg'] = '文件格式不正确!';
                    return response()->json($result);
                }
            }
            $image = $carImg->store('images');
            //返回响应
            return $image;
        }
        return $work;
    }

    public function avatarEdit(Request $request)
    {
        $avatarData = json_decode($request->input('avatar_data'),true);
        $avatar = $request->file('avatar_file');

        $img = Image::make($avatar);
        $img->crop(
            intval(round($avatarData['width'])),
            intval(round($avatarData['height'])),
            intval(round($avatarData['x'])),
            intval(round($avatarData['y']))
        );

        $imgPath = 'images/se-new/avatar/'.md5(time().\Auth::id()).'.png';
        $resource = $img->stream()->__toString();

        $disk = \Storage::disk('oss');
        $disk->put($imgPath, $resource);

        $avatarModel = Worker::whereId(\Auth::id())->first();
        $avatarModel->avatar = $imgPath;
        $avatarModel->save();

        return response()->json(['头像修改成功']);
    }
}