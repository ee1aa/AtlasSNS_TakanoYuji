<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function follow($user_id) //フォローする
    {
        return $this->follows()->attach($user_id);
    }

    public function unfollow($user_id) //フォロー解除
    {
        return $this->follows()->detach($user_id);
    }

    public function isFollowing($user_id) //フォローしているか確認
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->exists();
    }

    public function isFollowed($user_id) //フォローされているか確認
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->exists();
    }

    //投稿とのリレーション定義
    //「１対多」の「多」側を指定 → メソッド名は複数形でhasManyを使う
    public function posts(){
        return $this->hasMany('app\Post.php');
    }
}
