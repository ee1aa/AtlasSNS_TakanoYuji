<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    //followingsメソッド使用してフォローしているかチェックする
    public function followCheck($user){
        return $this->followings()->where('followed_id', $user)->exists();
    }

    //フォローユーザーとのリレーション定義
    public function followings(){
        //多対多 belongsToManyを使用
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id')->withTimestamps();
    }

    //フォロー数を取得する
    public function getFollowCountAttribute(){
        return $this->followings()->count();
    }

    //フォロワーユーザーとのリレーション定義
    public function follow(){
    return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id')->withTimestamps();
    }

    //フォロワー数を取得する
    public function getFollowerCountAttribute(){
        return $this->follow()->count();
    }

    //投稿とのリレーション定義
    //「１対多」の「多」側を指定 → メソッド名は複数形でhasManyを使う
    public function posts(){
        return $this->hasMany('App\Post');
    }
}
