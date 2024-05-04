<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }

    //検索ページ
    public function search(){
        return view('users.search');
    }

    //ユーザー検索機能
    public function userSearch(Request $request){
        //検索したワードを取得
        $keyword = $request->input('keyword');
        //空欄でないなら自分以外のあいまい検索、空欄なら自分以外のユーザーを全て表示
        if(!empty($keyword)){
            $users = User::where('username','like', '%'.$keyword.'%')->get();
        } else {
            $users = User::all();
        }
        //検索ページに戻る
        return view('users.search', ['users'=>$users]);
    }

    //フォロー機能
    public function follow(User $user)
    {
        $user = Auth::user();
        $follower = auth()->user(); //フォローしているか確認
        $is_following = $follower->isFollowing($user-id); //isFollowing:ユーザーが特定のユーザーをフォロー中か返す
        if (!is_following) { //もしフォローしていなければ
            $$follower->follow($user-id); //フォローする
        }
        return back();
    }

    //フォロー解除
    public function unfollow(User $user)
    {
        $user = Auth::user();
        $follower = auth()->user(); //フォローしているか確認
        $is_following = $follower->isFollowing($user-id); //isFollowing:ユーザーが特定のユーザーをフォロー中か返す
        if (!is_following) { //もしフォローしていれば
            $$follower->unfollow($user-id); //フォローする
        }
        return back();
    }
}
