<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    //投稿一覧
    public function index(){
        $posts = Post::latest()->get(); //投稿を最新のものから順に取得
        return view('posts.index', ['posts'=>$posts]); //ビューへデータを送って表示
    }

    //投稿機能
    public function postCreate(Request $request){
        //投稿フォームに書かれた内容を受け取る
        $validator = $request->validate([
            'post' => ['required', 'string', 'min:1', 'max:150']
        ]);

        //投稿の登録処理（テーブルに登録する）
        //Postテーブルの'user_id', 'post'に変数を当てはめる
        Post::create([
            'user_id' => Auth::user()->id,
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
            return redirect('/top')->with('success', '投稿を更新しました。');;
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

        //投稿内容をテーブルから削除
        $deleted = Post::where('id', $id)->delete();

        // 投稿一覧へ戻る
        if($deleted){
            return redirect('/top')->with('success', '投稿を削除しました。');
        }
        else{
            return redirect()->back()->with('error', '投稿の削除に失敗しました。');
        }
    }

    public function followList(){
        // ログインユーザーがフォローしているユーザーのIDを取得
        $following_ids = Auth::user()->followings()->pluck('followed_id')->toArray();

        // フォローしているユーザーの投稿を取得
        $posts = Post::with('user')->whereIn('user_id', $following_ids)->latest()->get();

        // フォローしているユーザーを取得
        $followings = Auth::user()->followings()->get();

        // dd($posts, $following_ids, $followings);

        return view('follows.followList', ['posts' => $posts, 'followings' => $followings]);
    }

    public function followerList(){
        // ログインユーザーがフォローされているユーザーのIDを取得
        $follower_ids = Auth::user()->follow()->pluck('following_id')->toArray();

        // フォローしているユーザーの投稿を取得
        $posts = Post::with('user')->whereIn('user_id', $follower_ids)->latest()->get();

        // フォローしているユーザーを取得
        $followers = Auth::user()->follow()->get();

        // dd($posts, $following_ids, $followings);

        return view('follows.followerList', ['posts' => $posts, 'followers' => $followers]);
    }
}
