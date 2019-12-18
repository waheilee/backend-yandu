<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Policy;
use App\Services\Admin\PolicyShowService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PolicyShowController extends Controller
{
    protected $policyShowService;


    public function __construct(PolicyShowService $policyShowService)
    {
        $this->policyShowService = $policyShowService;
    }

    public function index($id)
    {
        $row = Policy::join('merchants', 'policies.merchant_id', '=', 'merchants.id')
            ->select(DB::raw('merchants.company as merchant'), 'policies.*')
            ->find($id);
        return view('admin.policy.policy-show', compact(['row', 'id']));
    }

    public function showRequest(Request $request)
    {
        $data = $this->policyShowService->showList($request);
        return $data;
    }
}