<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderLog
 *
 * @property-read mixed $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $order_id
 * @property int $user_id 操作人
 * @property string $status 状态
 * @property string|null $remark 备注
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderLog whereUserId($value)
 */
class OrderLog extends Model
{

    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i', strtotime($value));
    }

    /**
     * 新增订单log
     * @param $order_id integer 订单ID
     * @param $status string 订单记录
     * @param int $user_id 用户ID，前台或者后台的用户ID，系统为0
     * @param string $remark 订单备注
     */
    public static function addLog($order_id,  $status, $user_id = 0, $remark = '')
    {
        static::insert([
            'order_id' => $order_id,
            'status' => $status,
            'user_id' => $user_id,
            'remark' => $remark,
            'created_at' => now()
        ]);
    }
}
