<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProjectDeposit
 *
 * @property int $id
 * @property int $merchant_id
 * @property int $project_id
 * @property int $deposit_type 押金类型，1交押金，2退押金
 * @property float $deposit 押金金额，押金余额
 * @property string|null $relate_order_id 关联订单ID
 * @property string|null $relate_order 关联订单
 * @property string|null $remark 操作备注
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectDeposit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectDeposit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectDeposit query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectDeposit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectDeposit whereDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectDeposit whereDepositType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectDeposit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectDeposit whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectDeposit whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectDeposit whereRelateOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectDeposit whereRelateOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectDeposit whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectDeposit whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $pr_mer_id 项目所属用户id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectDeposit wherePrMerId($value)
 * @property int $check_status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectDeposit whereCheckStatus($value)
 */
class ProjectDeposit extends Model
{

    protected $table = 'project_deposits';
}