<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProjectMerchant
 *
 * @property int $id
 * @property int $project_id 所属项目id
 * @property int $merchant_id 商户id
 * @property string $worker_id 工人id
 * @property int $status 状态:0未合作，1合作
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectMerchant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectMerchant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectMerchant query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectMerchant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectMerchant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectMerchant whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectMerchant whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectMerchant whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectMerchant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectMerchant whereWorkerId($value)
 * @mixin \Eloquent
 */
class ProjectMerchant extends Model
{

    protected $table = 'project_merchant';
}