<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];

    //ハッシュタグ表示のアクセサ#
    public function getHashtagAttribute(): string
    {
        return '#' . $this->name;
    }

    //記事モデルへのリレーション 多対多
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany('App\Article')->withTimestamps();
    }
}
