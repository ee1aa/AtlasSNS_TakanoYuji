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

    //投稿とのリレーション定義
    //「１対多」の「多」側を指定 → メソッド名は複数形でhasManyを使う
    public function posts(){
        return $this->hasMany('app\Post.php');
    }

    //フォロー・フォロワーのリレーション定義
    //「多対多」BelongsToManyを使う
    public function followers(): BelongsToMany {
        return $this->belongsToMany('app\User.php', 'follows', 'follow_id', 'follower_id')->withTimestamps();
    }
}
