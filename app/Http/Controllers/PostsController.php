<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\support\Facades\Auth;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    //投稿一覧
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

    //投稿内容の編集機能
    public function postUpdate(Request $request){
        // 投稿IDと編集内容を取得
        $id = $request->input('id');
        $up_post = $request->input('upPost');

        // IDをもとに投稿を更新
        //エラー処理も追記しておく
        Post::where('id', $id)->update([
            'post' => $up_post,
        ]);

        // 投稿一覧へ戻る
        if($request){
            return redirect('/top');
        }
        else{
            return redirect()->back()->with('error', '投稿の更新に失敗しました。');
        }
    }

    //投稿内容の削除機能
    public function postDelete(Request $request){
        // 投稿IDを取得
        $id = $request->input('post_id');
        // dd($request, $id);

        //投稿内容を削除
        $deleted = Post::where('id', $id)->delete();

        // 投稿一覧へ戻る
        if($deleted){
            return redirect('/top')->with('success', '投稿を削除しました。');
        }
        else{
            return redirect()->back()->with('error', '投稿の削除に失敗しました。');
        }
    }
}
