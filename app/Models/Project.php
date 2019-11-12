<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Project
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereBeginTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereBudget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereCashDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereCheckProjectTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project wherePartnerMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project wherePeopleNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereProjectName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereProjectTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Project extends Model
{
    protected $table = 'project';
}