<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

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
 * @mixin \Eloquent
 */
class Worker extends Model
{
    protected $table = 'worker';
}