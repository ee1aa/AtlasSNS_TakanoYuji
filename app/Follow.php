<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    // ユーザーがフォローしているユーザーを取得する関連メソッド
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }

    // ユーザーをフォローする関数
    public function follow($user_id)
    {
        $this->follows()->attach($user_id);
    }

    // ユーザーのフォローを解除する関数
    public function unfollow($user_id)
    {
        $this->follows()->detach($user_id);
    }

    // 特定のユーザーをフォローしているかどうかをチェックする関数
    public function isFollowing($user_id)
    {
        return $this->follows()->where('followed_id', $user_id)->exists();
    }
}
