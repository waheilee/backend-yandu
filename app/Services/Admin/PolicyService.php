<?php

namespace App\Services\Admin;

use App\Models\MemberPolicy;
use App\Models\Policy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Merchant;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class PolicyService
{

    public function indexAjax(Request $request)
    {
        $limit   = $request->input('limit');
        $rows = Policy::whereMerchantId( Auth::user()->id)->orderBy('created_at', 'desc')
            ->paginate($limit);
        foreach ($rows as $item){
            $item['company'] = "<a href='".url('admin/policy_show/'.$item['id'])."' target=\"_blank\">".$item['company']."</a>";
            $item['button'] = $this->getButton($item['qrcode'],$item['id']);
        }
        $array['page']  = $rows->currentPage();
        $array['rows']  = $rows->items();
        $array['total'] = $rows->total();
        return $array;
    }

    /**
     * 生成保单项目
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setStore(Request $request)
    {
        $company  = $request->input('company');
        $total    = $request->input('total');
        $address  = $request->input('address');
        $merchant = Merchant::find(Auth::user()->id);
        $used     = Policy::whereMerchantId( Auth::user()->id)->sum('policy_total');
        if (($total + $used) >= $merchant->policy_num) {
            return response()->json(['message'=>'保单数量达到上限'],400);
        }
        $model = new Policy();
        $model->merchant_id = Auth::user()->id;
        $model->company     = $company;
        $model->address     = $address;
        $model->policy_total= $total;
        $model->code        = str_pad(mt_rand(10, 999999),6, "0", STR_PAD_BOTH);
        $qrCodePath         = 'uploads/qrcode/policy/' . date('YmdHis') . rand(1000, 9999) . '.png';
        $model->qrcode      = $qrCodePath;
        $model->save();
        // 生成可访问的二维码
        QrCode::format('png')->size(300)->margin(0)->generate('http://mer.yd-hb.com/policy/' . $model->id, public_path($qrCodePath));
        return response()->json(['message'=>'保单项目添加成功']);
    }

    /**
     * 更新保单项目
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setUpdate(Request $request)
    {
        $company = $request->input('company');
        $total   = $request->input('total');
        $address = $request->input('address');
        $id      = $request->input('id');

        $count = Policy::whereMerchantId(Auth::user()->id)->whereId($id)->count();

        if ($count > 0) {
            Policy::whereId($id)->update([
                'company' => $company,
                'policy_total' => $total,
                'address' => $address
            ]);

            return response()->json(['message'=>'修改成功']);
        } else {
            return response()->json(['message'=>'无法处理此请求'],400) ;
        }
    }

    public function getButton($qrcode,$id)
    {
        $url = json_encode($qrcode);
        $button = "<button type=\"button\" class=\"btn btn-info btn-sm\" onclick='show_qrcode($url)'>二维码</button>".
                  "<button type=\"button\" class=\"btn btn-success btn-sm\" onclick='edit($id)'>编辑</button>".
                  "<button type=\"button\" class=\"btn btn-danger btn-sm \" onclick='del($id)'>删除</button>".
                  "<a class='btn btn-primary btn-sm' href='".url('admin/policy_show/'.$id)."' target=\"_blank\">查看详情</a>";
        return $button;
    }

    /**
     * 生成邀请识别码
     * @param $model
     * @return mixed
     */
//    private function getCode($model) {
//        $code = $model->CreateCode();
//        //把接收的邀请码再次返回给模型
//        if ($model->recode($code)) {
//            //不重复 返回验证码
//            return $code;
//        } else {
//            //重复 再次生成
//            while(true) {
//                $this->getCode($model);
//            }
//        }
//    }


}