<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //リレーション定義
    //「１対多」の「１」側 → メソッド名は単数形でbelongsToを使う
    public function author(){
        return $this->belongsTo('〇〇');
    }
}
