<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use app\User;
use App\Follow;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }

    //検索ページ
    public function search(){
        $users = User::latest()->get();
        return view('users.search', ['users'=>$users]);
    }

    //ユーザー検索機能
    public function userSearch(Request $request){
        //検索したワードを取得
        $keyword = $request->input('keyword');
        //空欄でないなら自分以外のあいまい検索、空欄なら自分以外のユーザーを全て表示する処理
        if(!empty($keyword)){
            $users = User::where('username','like', '%'.$keyword.'%')->get();
        } else {
            $users = User::all();
        }
        //検索ページに戻る
        return view('users.search', [
            'users' => $users, //検索結果を取得した変数
            'keyword' => $keyword //検索語句をビューに渡す
        ]);
    }

    //フォロー機能
    public function follow(Request $request)
    {
        $user_name = $request->input('user_id');
        $follower = auth()->user(); //フォローしているか確認
        $is_following = $follower->followings()->where('followed_id', $user_name)->exists(); //followings:ユーザーが特定のユーザーをフォロー中か返す
        if (!$is_following) { //もしフォローしていなければ
            $follower->follow($user_name); //フォローする
        }

        //フォローの登録処理（followsテーブルに登録する）
        //followsテーブルの'following_id', 'followed_id'に変数を当てはめる
        Follow::create([
            'following_id' => Auth::user()->id,
            'followed_id' => $user_name
        ]);

        return back();
    }

    //フォロー解除
    public function unfollow(Request $request)
    {
        $user_name = $request->input('user_id');
        $follower = auth()->user(); //フォローしているか確認
        $is_following = $follower->followings()->where('followed_id', $user_name)->exists(); //followings:ユーザーが特定のユーザーをフォロー中か返す
        if ($is_following) { //もしフォローしていれば
            $follower->follow($user_name); //フォロー解除する
        }

        //フォローの削除処理（followsテーブルからfollowed_idに該当するIDを削除）
        $deleted = Follow::where('followed_id', $user_name)->delete();

        return back();
    }

    public function followList(){
        // ログインユーザーがフォローしているユーザーを取得
        $followings = Auth::user()->followings()->get();
        // dd($followings);

        // ビューにデータを渡す
        return view('follows.followList', compact('followings'));
}

}
