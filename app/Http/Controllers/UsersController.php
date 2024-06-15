<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
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

        // ビューにデータを渡す
        return view('follows.followList', compact('followings'));
    }

    public function followerList(){
        // ログインユーザーがフォローされているユーザーを取得
        $followers = Auth::user()->followers()->get();

        // ビューにデータを渡す
        return view('follows.followerList', compact('followers'));
    }

    // プロフィール編集画面の表示
    public function editProfile()
    {
        $user = Auth::user();
        return view('users.editProfile', compact('user'));
    }

    // プロフィール更新処理
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // バリデーション
        $request->validate([
            'username' => 'required|string|min:2|max:12',
            'mail' => 'required|string|email|min:5|max:40|unique:users,mail,' . $user->id,
            'password' => 'nullable|string|min:8|max:20|confirmed',
            'bio' => 'nullable|string|max:150',
            'images' => 'nullable|image|mimes:png,jpg,bmp,gif,svg|max:2048',
        ]);

        // プロフィール情報の更新
        $user->username = $request->username;
        $user->mail = $request->mail;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->bio = $request->bio;

        if ($request->hasFile('images')) {
            // 古い画像を削除する
            if ($user->images && $user->images !== 'default.png') {
                Storage::delete('public/images/' . $user->images);
            }

            // 新しい画像を保存する
            $imageName = time() . '.' . $request->images->extension();
            $request->images->storeAs('public/images', $imageName);
            $user->images = $imageName;
        }

        $user->save();

        return redirect('/top')->with('success', 'プロフィールを更新しました。');
    }

    //プロフィールページ
    public function profile(User $user)
    {
        return view('users.profile', compact('user'));
    }

    //ユーザーの投稿を取得
    public function showProfile(User $user){
        $posts = $user->posts()->latest()->get();

        return view('users.profile', compact('user', 'posts'));
    }

}
