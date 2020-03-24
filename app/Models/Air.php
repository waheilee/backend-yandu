<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Air
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air query()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $no 订单流水号
 * @property int|null $user_id 订单所属商家
 * @property float|null $total 总计价格
 * @property int|null $status
 * @property string|null $pay_type 支付类型
 * @property string|null $area 施工面积
 * @property int|null $type 订单类型,1普通订单，2秒杀订单
 * @property string|null $name 订单的名字，用于第三方，只有一个商品就是商品的名字，多个商品取联合
 * @property string|null $consignee_name 收货人
 * @property string|null $consignee_phone 收货人手机号码
 * @property string|null $consignee_address 收货地址
 * @property string|null $pay_no 第三方支付单号
 * @property float|null $pay_total 实际支付金额
 * @property string|null $pay_time 支付时间
 * @property float|null $pay_refund_fee 退款金额
 * @property string|null $pay_trade_no 第三方退款订单号
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air whereConsigneeAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air whereConsigneeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air whereConsigneePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air whereNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air wherePayNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air wherePayRefundFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air wherePayTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air wherePayTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air wherePayTradeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air wherePayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Air whereUserId($value)
 */
class Air extends Model
{

    protected $table = 'air_orders';

    public function details()
    {
        return $this->hasMany(AirOrderDetail::class);
    }

    public function isNotUser($id)
    {
        return $this->user_id != $id;
    }

    public static function boot()
    {
        parent::boot();
        static::deleted(function ($model)
        {
            //这样可以拿到当前操作id
            try {

                /**
                 * @var $order Order
                 */
                $order = static::withTrashed()->findOrFail($model->id);
                $order->details()->delete();
                $order->forceDelete();

                $data = [
                    'status'  => true,
                    'message' => trans('admin.delete_succeeded'),
                ];
            } catch (\Throwable $e) {
                $data = [
                    'status'  => false,
                    'message' => trans('admin.delete_failed') . $e->getMessage(),
                ];
            }

            return response()->json($data);
        });

        // 自动生成订单的订单号
        static::creating(function ($model) {

            if (is_null($model->no)) {
                $model->no = static::findAvailableNo($model->user_id);
            }
        });


    }

    /**
     * @param string $userId
     * @param int    $try
     * @return string
     * @throws \Exception
     */
    public static function findAvailableNo($userId = '000000000', $try = 5)
    {
        $prefix = date('YmdHis');
        $suffix = fixStrLength($userId, 9);

        for ($i = 0; $i < $try; ++ $i) {
            $no = $prefix . fixStrLength(random_int(0, 9999), 5) . $suffix;

            if (self::query()->where('no', $no)->doesntExist()) {
                return $no;
            }
        }

        throw new \Exception('流水号生成失败');
    }
}