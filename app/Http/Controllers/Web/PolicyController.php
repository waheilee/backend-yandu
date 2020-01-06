<?php

namespace App\Http\Controllers\Web;


use App\Models\MemberPolicy;
use App\Models\Policy;
use App\Requests\Web\PolicyStoreRequest;
use Illuminate\Http\Request;
use Ofcold\IdentityCard\IdentityCard;
class PolicyController
{

    /**
     * 保单详情，供终端人员填写
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, $id)
    {
        $row = Policy::select('policies.id', \DB::raw('merchants.company as merchant'), 'policies.company', 'policy_total', 'policy_used','merchant_id')
            ->join('merchants', 'merchants.id', '=', 'policies.merchant_id')
            ->where('policies.id', $id)->first();
//        dd($row);
        return view('web.policy.index',compact('row'));
    }

    public function create($id)
    {
        $row = Policy::select('policies.id', \DB::raw('merchants.company as merchant'), 'policies.company', 'policy_total', 'policy_used','merchant_id')
            ->join('merchants', 'merchants.id', '=', 'policies.merchant_id')
            ->where('policies.id', $id)->first();
        return view('web.policy.create',compact('row'));
    }

    /**
     * 用户填写保单
     * @param PolicyStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PolicyStoreRequest $request)
    {
        $cardNum = $request->input('idcard');
        $policyId = $request->input('policy_id');
        $code = $request->input('code');
        $card = IdentityCard::make($cardNum);
        if ($card === false) {
            return response()->json(['errors' =>['idcard'=>[0=>'身份证证件号码不正确']]], 422);
        }
        $policy = Policy::whereId($policyId)->first();
        if ($code != $policy->code){
            return response()->json(['errors' =>['code'=>[0=>'邀请识别码不正确']]], 422);
        }
        if ($policy->policy_used === $policy->policy_total){
            return response()->json(['errors' =>['code'=>[0=>'保单数量已达上限']]], 422);
        }
        $polices = MemberPolicy::wherePolicyId($policyId)->whereIdcard($cardNum)->first();
        if ($polices){
            return response()->json(['errors' =>['code'=>[0=>'被投保人已投保过此项目，请勿重复添加']]], 422);
        }
        $model = new MemberPolicy();
        $model->policy_id   = $policyId;
        $model->merchant_id = $request->input('merchant_id');
        $model->username    = $request->input('username');
        $model->idcard      = $cardNum;
        $model->phone       = $request->input('phone');
        $model->email       = $request->input('email');
        $model->position    = $request->input('position');
        $model->payroll     = $request->input('payroll');
        $model->age         = 1;
        $model->order_no    = 0;
        $model->save();
        Policy::where('id', $request->get('policy_id'))->increment('policy_used');
        return response()->json(['message'=>'保单添加成功']);

    }
}