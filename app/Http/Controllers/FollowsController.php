<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //Authファサードを使用
use Illuminate\Support\Facades\DB; //DBファサードを使用
use APP\User;  //User.phpを使用
use APP\Post; //Post.phpを使用
use APP\Follow; //Follow.phpを使用

class FollowsController extends Controller
{
    //フォローリスト
    // public function followList(){
    //     return view('follows.followList');
    // }

    //フォロワーリスト
    public function followerList(){
        return view('follows.followerList');
    }

    //謎のメソッド
    public function show(User $user)
    {
        $login_user = auth()->user();
        $is_following = $login_user->followings($login_user->id);
        $is_followed = $login_user->isFollowed($login_user->id);
        $follow_count = $follow->getFollowCount($login_user->id);
        $follower_count = $follow->getFollowerCount($login_user->id);

        return view('/', [
            'user'           => $user,
            'is_following'   => $is_following,
            'is_followed'    => $is_followed,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }
}
