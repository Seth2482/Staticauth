<?php

namespace App;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $fillable = ['name', 'extra', 'git'];

    public function sites()
    {
        return $this->hasMany(Site::class);
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


}
