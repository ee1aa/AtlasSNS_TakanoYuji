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
        $posts = Post::latest()->get(); //投稿を最新のものから順に取得
        return view('posts.index',['posts'=>$posts]); //ビューへデータを送って表示
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
            'name' => Auth::user()->name,
            'post' => $request->post
        ]);
        return redirect('/top');
    }

    //編集する投稿を送る
    public function updateForm($id){
        $book = Post::where('id', $id)->first();
        return view('posts.updateForm', ['post'=>$post]);
    }

    public function update(Request $request){
        // 1つ目の処理
        $id = $request->input('id');
        $up_post = $request->input('upPost');
        // 2つ目の処理
        Post::where('id', $id)->update([
            'post' => $up_post,
        ]);
        // 3つ目の処理
        return redirect('/top');
    }

}
