<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\MemberPolicy
 *
 * @property int $id
 * @property int|null $member_id
 * @property int $policy_id 保单公司ID
 * @property string $username 职员姓名
 * @property string $idcard 身份证号
 * @property string|null $age 年龄
 * @property string $phone 手机号
 * @property string|null $email 邮箱
 * @property string $position 职位
 * @property string|null $payroll 薪资范围
 * @property string|null $policy_no 保单号
 * @property string|null $policy_img 保单图片
 * @property string|null $effective_date 生效日期
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $merchant_id 保单所属商户id
 * @property string|null $out_time 保单过期时间
 * @property string $order_no 关联订单号
 * @property string|null $policy_type 保单类型
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy whereEffectiveDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy whereIdcard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy whereOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy whereOutTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy wherePayroll($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy wherePolicyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy wherePolicyImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy wherePolicyNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy wherePolicyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberPolicy whereUsername($value)
 * @mixin \Eloquent
 */
class MemberPolicy extends Model
{
    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }

    public function orderMerchant()
    {
        return $this->hasOne('App\Models\OrderMerchant','order_num','order_no');
    }
}
