<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Policy
 *
 * @property int $id
 * @property int $merchant_id 商家ID
 * @property string $company 公司名称
 * @property int $policy_total 分配保单数
 * @property int $policy_used 已填写保单数
 * @property string $qrcode 生成的二维码
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $address
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy wherePolicyTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy wherePolicyUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereQrcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Policy extends Model
{
    protected $hidden = ['updated_at'];

    protected $attributes = [
          'policy_used' => 0
    ];

    public function getQrcodeAttribute($value)
    {
        return url($value);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i', strtotime($value));
    }
}
