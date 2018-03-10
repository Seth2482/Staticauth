<?php

namespace App;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use SoftDeletes;

    const STATUS_UNCOMMIT = 0;
    const STATUS_COMMITTED = 1;
    const STATUS_FAILED = -1;

    protected $fillable = ['url', 'project_id', 'expire_at', 'status', 'extra'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }


    // Extra 修改器

    public function getExtraAttribute($value): array
    {
        // 暴力模式
        return json_decode($value, true);
    }

    public function setExtraAttribute($value)
    {
        if (!is_array($value) && $value instanceof Jsonable) {
            $value = $value->toJson();
        } else {
            $value = json_encode($value);
        }

        $this->attributes['extra'] = $value;
    }

    public function statusText()
    {
        $text = [
            self::STATUS_UNCOMMIT => '等待提交',
            self::STATUS_COMMITTED => '正常',
            self::STATUS_FAILED => '提交失败'
        ];

        if (isset($text[$this->status])) {
            return $text[$this->status];
        } else {
            return '未知状态：' . $this->status;
        }
    }

}
