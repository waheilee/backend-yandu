<?php

namespace App\Http\Controllers\Web;


use App\Models\Air;
use App\Models\AirOrderDetail;
use Illuminate\Http\Request;

class AirController
{

    public function index($id)
    {
        if (empty($id)){
            return '请从商家二维码跳转、或链接跳转';
        }
        return view('web.air.index',compact('id'));
    }

    public function create(Request $request)
    {
        $city = $request->input('city');//地区
        $area = $request->input('area');//面积
        $name = $request->input('name');//姓名
        $phone = $request->input('phone');//电话
        $address = $request->input('address');//详细地址
        $product = $request->input('order');//订单详情
        $id = $request->input('id');
        $total = $request->input('totals');
        $orderModel = new Air();
//        $orderModel->name = json_encode($city,JSON_UNESCAPED_UNICODE);
        $orderModel->user_id = 1;
        $orderModel->total = $total;
        $orderModel->area = $area;
        $orderModel->consignee_name = $name;
        $orderModel->consignee_phone = $phone;
        $orderModel->consignee_address = $city.$address;
        $orderModel->user_id = $id;
        $orderModel->save();
        $this->product($product,$orderModel->id);

        return response()->json(['订单提交成功']);
    }

    public function product($data,$id)
    {
        foreach ($data as $k=>$v){
            if ($v['number'] == 0){
                continue;
            }else{
                $detailModel = new AirOrderDetail();
                $detailModel->order_id = $id;
                $detailModel->product_id = $k;
                $detailModel->price = 0;
                $detailModel->number = $v['number'];
                $detailModel->total = $v['total'];
                $detailModel->save();
            }
        }
    }
}