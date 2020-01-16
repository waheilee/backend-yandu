<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
/**
 * App\Models\Worker
 *
 * @property int $id
 * @property string $card_a 身份证正面照片链接
 * @property string $card_b 身份证方面照片链接
 * @property string $card_num 身份证号码
 * @property string $name 工人姓名
 * @property int $age 工人年龄
 * @property int $sex 工人性别
 * @property string $phone 工人电话
 * @property string|null $email 邮箱
 * @property string $province 省份
 * @property string $city 市
 * @property string $county 县、区
 * @property int $tec 技能
 * @property int $work_age 工作年龄
 * @property string|null $tec_text 其他技能
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $merchant_id 所属商户id
 * @property string|null $qrcode 工人信息二维码
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereCardA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereCardB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereCardNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereCounty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereTec($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereTecText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereWorkAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereQrcode($value)
 * @mixin \Eloquent
 * @property string|null $avatar 工人头像
 * @property string|null $channel 工人所需渠道
 * @property string|null $password 密码
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker wherePassword($value)
 * @property int|null $is_active 判断首次登录
 * @property string|null $remember_token
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereRememberToken($value)
 * @property string|null $policy_order_num 关联保单订单号
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker wherePolicyOrderNum($value)
 */
class Worker extends Authenticatable
{
    protected $table = 'worker';
    protected $fillable = ['card_a','card_b','age','sex','tec','work_age','avatar','name','phone','card_num','province','city','county','password','channel',];
}