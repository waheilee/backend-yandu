<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProjectCheck
 *
 * @property int $id
 * @property int $project_id 所属项目ID
 * @property int $merchant_id 验收提交方ID
 * @property string $content 验收报告
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectCheck newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectCheck newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectCheck query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectCheck whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectCheck whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectCheck whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectCheck whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectCheck whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectCheck whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProjectCheck extends Model
{
    protected $table = 'project_check';
}