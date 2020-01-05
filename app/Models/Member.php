<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Member
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $nickname 微信昵称
 * @property string $avatar 头像
 * @property string $openid
 * @property string|null $api_token
 * @property float $deposit 用户押金
 * @property int $rent 租赁次数
 * @property int $policy 保单数
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $web_openid
 * @property string $mini_openid
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereMiniOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member wherePolicy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereRent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereWebOpenid($value)
 */
class Member extends Model
{
    protected $fillable = ['nickname', 'avatar', 'openid', 'api_token', 'deposit', 'rent', 'policy', 'mini_openid', 'web_openid'];

    protected $hidden = ['updated_at'];
}
