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

    public function search(){
        return view('users.search');
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
