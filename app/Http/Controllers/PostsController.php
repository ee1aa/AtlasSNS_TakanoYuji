<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function index(){
        $user = Auth::user(); //ログイン認証しているユーザーの取得
        $username = Auth::user()->username;
        return view('posts.index'); //現在認証しているユーザーを取得
    }

    //投稿を表示する
    public function create(){
        return view('post/create');
    }

    //投稿機能
    public function store(Request $Request){
        $post = new Post;
        $post->id = $request->session()->get('id');
        $post->user_id = $request->user_id;
        $post->post = $request->post;
        $post->save();
        return redirect()->route('post.create');
    }
}
