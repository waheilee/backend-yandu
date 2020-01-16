<?php

namespace App\Http\Controllers\Admin;

use App\Models\MemberPolicy;
use App\Models\Merchant;
use App\Models\Policy;
use App\Requests\Admin\MerchantPolicyRequest;
use App\Services\Admin\PolicyService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PolicyController extends Controller
{
    protected $policyService;


    public function __construct(PolicyService $policyService)
    {
        $this->policyService = $policyService;
    }
    /**
     * 保单详情，供终端人员填写
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        $row = Policy::select('policies.id', DB::raw('merchants.company as merchant'), 'policies.company', 'policy_total', 'policy_used')
            ->join('merchants', 'merchants.id', '=', 'policies.merchant_id')
            ->where('policies.id', $id)->first();
        return $this->json($row);
    }

    /**
     * 商户创建的表单
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {

        $merchant = Merchant::whereId( Auth::user()->id)->first();
        $row = Policy::whereMerchantId( Auth::user()->id)
            ->first([
                DB::raw('count(id) as policies'),
                DB::raw('sum(policy_total) as policy_used')
            ]);
        $row->policy_total = $merchant->policy_num - $row->policy_used;
        if ($row->policy_total <= 0) $row->policy_total = 0;
        if ($row->policy_used == null) $row->policy_used = 0;
//        return response()->json($row, 200, [], JSON_UNESCAPED_UNICODE);
        return view('admin.policy.index',['row'=>$row]);
    }

    public function indexRequest(Request $request)
    {
        $data =$this->policyService->indexAjax($request);
        return $data;
    }


    /**
     * 商户新增项目
     * @param MerchantPolicyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MerchantPolicyRequest $request)
    {
        $data = $this->policyService->setStore($request);
        return $data;

    }

    /**
     * 编辑
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {
        $id = $request->input('id');
        $model = Policy::whereId($id)->first();
        return response()->json($model);
    }

    /**
     * 更新
     * @param MerchantPolicyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MerchantPolicyRequest $request)
    {
        $data = $this->policyService->setUpdate($request);
        return $data;
    }

    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $count = Policy::whereMerchantId(Auth::user()->id)->whereId($id)->count();

        if ($count > 0) {
            Policy::whereId( $id)->delete();
            MemberPolicy::wherePolicyId($id)->delete();
            return response()->json(['message'=>'删除成功']);
        } else {
            return response()->json(['message'=>'无法处理此请求'],400);
        }
    }

}
