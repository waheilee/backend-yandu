<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderMerchant
 *
 * @property int $id
 * @property string $order_num 订单流水号
 * @property string|null $pay_order_num 支付平台返回的单号
 * @property string|null $refund_trade_no 退款单号
 * @property int $user_id 下单用户id
 * @property string|null $address 地址
 * @property int|null $type 商品类型（例如：项目保证金、购买保单）
 * @property float $total_amount 订单总金额
 * @property string|null $pay_time 支付时间
 * @property string|null $refund_time 退款时间
 * @property int $pay_status 支付状态，0未支付，1已支付，2已退款，3已过期
 * @property int $refund_status 是否已退款
 * @property int $order_status 订单状态
 * @property int $channel 渠道,渠道分两种微信支付宝
 * @property string|null $remark 订单备注
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant whereChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant whereOrderNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant whereOrderStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant wherePayOrderNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant wherePayStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant wherePayTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant whereRefundStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant whereRefundTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant whereRefundTradeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderMerchant whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\ProjectOrder $project
 * @property-read \App\Models\MemberPolicy $policy
 */
class OrderMerchant extends Model
{
    protected $table = 'order_merchant';

    public function project()
    {
        return $this->belongsTo('App\Models\ProjectOrder','order_no','order_no');
    }

    public function policy()
    {
        return $this->belongsTo('App\Models\MemberPolicy','order_no','order_no');
    }
}