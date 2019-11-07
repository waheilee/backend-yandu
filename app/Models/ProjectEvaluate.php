<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProjectEvaluate
 *
 * @property int $id
 * @property int $project_id 所属项目ID
 * @property int $evaluate_id_a 评价人
 * @property int $evaluate_id_b 被评价人
 * @property int $start 评价星星数量
 * @property string $tag 评价标签
 * @property string $content 评价内容
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectEvaluate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectEvaluate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectEvaluate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectEvaluate whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectEvaluate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectEvaluate whereEvaluateIdA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectEvaluate whereEvaluateIdB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectEvaluate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectEvaluate whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectEvaluate whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectEvaluate whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectEvaluate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProjectEvaluate extends Model
{
    protected $table = 'project_evaluate';
}