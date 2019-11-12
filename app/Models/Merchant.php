<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * App\Models\Merchant
 *
 * @property int $id
 * @property string $category 商家类型
 * @property string $company 公司名称
 * @property string $logo
 * @property string|null $name 企业联系人
 * @property string|null $tags 商家标签
 * @property string|null $intro 商家简介
 * @property string|null $reports 检测报告
 * @property string $phone 联系方式
 * @property string|null $province 省份
 * @property string|null $city 城市
 * @property string $address 公司地址
 * @property string|null $introduction 公司介绍
 * @property int $sort 排序
 * @property int $status 状态。0禁用，1正常
 * @property string|null $longitude 经度
 * @property string|null $latitude 纬度
 * @property string $username 用户名
 * @property string $password 密码
 * @property int|null $page_views 页面浏览次数
 * @property int|null $page_views_real 页面浏览次数
 * @property int|null $contact_views 联系方式浏览次数
 * @property int|null $contact_views_real 联系方式浏览次数
 * @property int|null $policy_num 保单数量
 * @property string|null $api_token
 * @property int $is_delete
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $is_recommend 是否推荐
 * @property string|null $join_at 入驻时间
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereContactViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereContactViewsReal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereIntro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereIntroduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereIsDelete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereIsRecommend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereJoinAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant wherePageViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant wherePageViewsReal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant wherePolicyNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereReports($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereUsername($value)
 * @mixin \Eloquent
 * @property string|null $remember_token
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereRememberToken($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Worker[] $workers
 * @property-read int|null $workers_count
 */
class Merchant extends Authenticatable
{

//    protected $table = 'merchants';

    public function workers()
    {
        return $this->hasMany(Worker::class, 'merchant_id', 'id');
    }
}