<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //リレーション定義
    //「１対多」の「１」側を指定 → メソッド名は単数形でbelongsToを使う
    public function user(){
        return $this->belongsTo('app\User.php');
    }
}
