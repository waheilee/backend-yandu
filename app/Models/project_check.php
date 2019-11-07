<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\project_check
 *
 * @property int $id
 * @property int $project_id 所属项目ID
 * @property int $merchant_id 验收提交方ID
 * @property string $content 验收报告
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\project_check newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\project_check newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\project_check query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\project_check whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\project_check whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\project_check whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\project_check whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\project_check whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\project_check whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class project_check extends Model
{
    protected $table = 'project_check';
}