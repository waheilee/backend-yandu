<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProjectOrder
 *
 * @property int $id
 * @property int $merchant_id 付款商户id
 * @property int $project_id 付款项目id
 * @property string $order_no 订单号
 * @property string $money 订单押金金额
 * @property int|null $is_delay 是否超时
 * @property string $refund_trade_no 退款单号
 * @property int $pay_status 支付状态，0未支付，1已支付，2已退款，3已过期
 * @property string $channel 渠道,渠道分两种 WEB和MINI
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereIsDelay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder wherePayStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereRefundTradeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $worker_id 工人id
 * @property int $status 状态:0未合作，1合作
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereWorkerId($value)
 */
class ProjectOrder extends Model
{

    protected $table = 'project_order';
}