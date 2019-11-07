<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProjectOrder
 *
 * @property int $id
 * @property string $num 项目编号，自动生成
 * @property int $merchant_id 订单所属用户ID
 * @property string $project_name 项目名称
 * @property string $address 项目地点
 * @property string $begin_time 项目开始时间
 * @property string $end_time 项目结束时间
 * @property string $size 项目平米数大小
 * @property string $project_time 预估项目工期
 * @property string $budget 项目成本预算价格
 * @property string $cash_deposit 乙方所欲缴纳的保证金
 * @property int $people_num 乙方参与此项目所需达到的最低施工人数
 * @property string $phone 联系方式
 * @property string $content 项目详情介绍
 * @property int|null $status 项目状态,0、未承接，1、已承接，2、竣工
 * @property string|null $interest 对此项目有意向的商户
 * @property int|null $partner_merchant_id 最终合作商户ID（乙方）
 * @property string|null $check_project_time 项目验收时间
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereBeginTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereBudget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereCashDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereCheckProjectTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder wherePartnerMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder wherePeopleNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereProjectName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereProjectTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectOrder whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProjectOrder extends Model
{
    protected $table = 'project_order';
}