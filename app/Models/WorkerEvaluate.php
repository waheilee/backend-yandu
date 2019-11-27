<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WorkerEvaluate
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkerEvaluate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkerEvaluate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkerEvaluate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkerEvaluate whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkerEvaluate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkerEvaluate whereEvaluateIdA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkerEvaluate whereEvaluateIdB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkerEvaluate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkerEvaluate whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkerEvaluate whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkerEvaluate whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkerEvaluate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WorkerEvaluate extends Model
{

    protected $table = 'worker_evaluate';
}