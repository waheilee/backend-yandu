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
 * @property string $code 保单邀请码
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereCode($value)
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

    /**
     * 模型内生成邀请码 并返回控制器
     * @return string
     */
    public function CreateCode() {
        $code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand = $code[rand(0,25)]
            .strtoupper(dechex(date('m')))
            .date('d').substr(time(),-5)
            .substr(microtime(),2,5)
            .sprintf('%02d',rand(0,99));
        for(
            $a = md5( $rand, true ),
            $s = '0123456789ABCDEFGHIJKLMNOPQRSTUV',
            $d = '',
            $f = 0;
            $f < 6;
            $g = ord( $a[ $f ] ),
            $d .= $s[ ( $g ^ ord( $a[ $f + 8 ] ) ) - $g & 0x1F ],
            $f++
        );
        return $d;
    }

    /**
     * 判断验证码是否存在数据库中
     * @param $code
     * @return bool
     */
    public function recode($code) {
        if ($this->where('code','=',$code)->first()) {
            return false;
        }
        return true;
    }
}
