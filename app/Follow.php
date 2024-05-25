<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    // データベースでいじるところを許可する
    protected $fillable = [
        'following_id', 'followed_id'
    ];

    //フォローユーザーとのリレーション定義
    public function followings(){
        //多対多 belongsToManyを使用
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id')->withTimestamps();
    }

    //フォロワーユーザーとのリレーション定義
    public function follow(){
    return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id')->withTimestamps();
    }
}
