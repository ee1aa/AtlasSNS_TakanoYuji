<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\support\Facades\Auth;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function index(){
        $user = Auth::user(); //ログイン認証しているユーザーの取得
        $username = Auth::user()->username;
        return view('posts.index', ['posts'=>$posts]); //bladeへデータを送る
    }

    //投稿機能
    public function postCreate(Request $request){
        //投稿フォームに書かれた内容を受け取る
        $validator = $request->validate([
            'post' => ['required', 'string', 'min:1', 'max:150']
        ]);

        //投稿の登録処理
        //Postテーブルの'user_id', 'post'に変数を当てはめる
        Post::create([
            'user_id' => Auth::user()->id,
            'post' => $request->post
        ]);
        return redirect('/top');
    }
}
