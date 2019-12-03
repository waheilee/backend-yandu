<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\News
 *
 * @property-read mixed $content
 * @property-read mixed $created_at
 * @property-read mixed $full_cover
 * @property-read mixed $modify_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $title 资讯标题
 * @property string $summary 摘要
 * @property string $category 资讯分类
 * @property string $cover 略缩图
 * @property int|null $views 浏览量
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $seo
 * @property int|null $is_recommend
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereIsRecommend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereModifyTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereSeo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereViews($value)
 */
class News extends Model
{
    const HOT = 'hot';
    const QUESTION = 'question';
    const NEWS = 'news';

    protected $attributes = [
        'views' => 0
    ];

    public static function getNewsWithFilter($filter, $currentPage = 1, $perPage = 20, $order_field = 'modify_time', $order_type = 'desc')
    {
        $columns = ['id', 'title', 'summary', 'category', 'cover', 'views', 'modify_time', 'created_at'];
        $pageName = 'page';
        if ($filter) {
            return static::where('category', strtolower($filter))
                ->orderBy('is_recommend', 'desc')
                ->orderBy($order_field, $order_type)
                ->paginate($perPage, $columns, $pageName, $currentPage);
        } else {
            return static::orderBy($order_field, $order_type)
                ->paginate($perPage, $columns, $pageName, $currentPage);
        }
    }

    public static function getNewsBySearch($search, $currentPage = 1, $perPage = 20)
    {
        $columns = ['id', 'title', 'summary', 'category', 'cover', 'views', 'modify_time', 'created_at'];
        $pageName = 'page';
        return static::whereNotIn('category', [])
            ->where('title', 'like', "%$search%")
            ->orderBy('modify_time', 'desc')
            ->paginate($perPage, $columns, $pageName, $currentPage);
    }

    public function getModifyTimeAttribute($value)
    {
        if ($value) {
            return date('Y-m-d H:i', strtotime($value));
        } else {
            return '';
        }
    }

    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i', strtotime($value));
    }

    public function getContentAttribute($value)
    {
        return str_replace('src="/ueditor/php', 'src="' . url('/') . '/ueditor/php', $value);
    }

    public function getFullCoverAttribute()
    {
        return Storage::url($this->cover);
    }
}
