<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Mass Assignment（大量代入）操作時に許可される属性を指定
    protected $fillable = [
        'user_id', 'post'
    ];

    //リレーション定義
    //「１対多」の「１」側を指定 → メソッド名は単数形でbelongsToを使う
    public function user(){
        return $this->belongsTo('App\User');
    }
}
