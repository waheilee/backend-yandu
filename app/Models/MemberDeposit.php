<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MemberDeposit
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberDeposit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberDeposit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberDeposit query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $member_id
 * @property int $deposit_type 押金类型，1交押金，2退押金
 * @property float $deposit 押金金额，押金余额
 * @property string|null $relate_order_id 关联订单ID
 * @property string|null $relate_order 关联订单
 * @property int|null $user_id 操作人
 * @property string|null $remark 操作备注
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberDeposit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberDeposit whereDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberDeposit whereDepositType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberDeposit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberDeposit whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberDeposit whereRelateOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberDeposit whereRelateOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberDeposit whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberDeposit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberDeposit whereUserId($value)
 */
class MemberDeposit extends Model
{
    protected $table = 'member_deposits';
}
