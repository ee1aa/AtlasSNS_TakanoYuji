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

    //フォローユーザーとのリレーション定義
    public function isFollowing(){
        //多対多 belongsToManyを使用
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id')->withTimestamps();
    }

    //フォロワーユーザーとのリレーション定義
    public function follow(){
    return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id')->withTimestamps();
    }

    //投稿とのリレーション定義
    //「１対多」の「多」側を指定 → メソッド名は複数形でhasManyを使う
    public function posts(){
        return $this->hasMany('App\Post');
    }
}
