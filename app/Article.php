<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//1対多
use Illuminate\Database\Eloquent\Relations\BelongsTo;
//多対多
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    protected $fillable = [
        'title',
        'body',
    ];

    //1対多の関係を定義
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    //多対多の関係を定義 belongsToMany(関係するモデル名, 中間テーブル名)
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    //いいね機能　nullかどうかの判定
    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()
            : false;
    }

    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }

    //タグモデルへのリレーション
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
}
