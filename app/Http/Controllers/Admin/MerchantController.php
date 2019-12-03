<?php

namespace App\Http\Controllers\Admin;


use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController
{

    public function index()
    {
        $model = Merchant::whereId(\Auth::user()->id)->first();
        return view('admin.usercenter.index',['user'=>$model]);
    }

    /**
     * 商户更新简介
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateIntro(Request $request)
    {
        $intro = $request->input('content');
        Merchant::whereId(\Auth::user()->id)->update([
            'introduction' => $intro
        ]);

        return response()->json(['message'=>'修改成功']);
    }
}