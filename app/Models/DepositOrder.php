<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DepositOrder
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $member_id 用户ID
 * @property string $out_trade_no 押金商户订单号
 * @property string $total_fee 金额，单位元
 * @property int $order_status 0未支付，1已支付，2已过期
 * @property string $prepay_id 预支付交易会话标识
 * @property string|null $code_url 腾讯返回的二维码信息
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereCodeUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereOrderStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereOutTradeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder wherePrepayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereTotalFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereUpdatedAt($value)
 */
class DepositOrder extends Model
{
    protected $attributes = [
        'order_status' => 0
    ];
}
