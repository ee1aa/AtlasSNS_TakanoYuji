<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

// LaravelのルーティングクラスであるRouteクラスを参照する
use Illuminate\Support\Facades\Route;

//ログアウト中のページ　ログイン
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

//ログアウト中のページ　ユーザー登録
Route::get('/register', 'Auth\RegisterController@registerView');
Route::post('/registerCreate', 'Auth\RegisterController@register');

//ログアウト中のページ　登録完了
Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
// ミドルウェアを使用して複数のルートに適用する
//ログイン中のページ
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/top', 'PostsController@index')->name('top'); // ホームページ

    Route::post('/postCreate', 'PostsController@postCreate')->name('post.create'); // 投稿機能
    Route::post('/post/update', 'PostsController@postUpdate')->name('post.update'); // 編集機能
    Route::post('/post/delete', 'PostsController@postDelete')->name('post.delete'); // 削除機能

    Route::post('/profile', 'UsersController@profile')->name('profile.update'); // プロフィール更新
    Route::get('/profile', 'UsersController@profile')->name('profile.view'); // プロフィール表示

    Route::post('/search', 'UsersController@search')->name('search'); // ユーザー検索

    Route::post('/follow.unfollow', 'UsersController@unfollow')->name('follow.unfollow'); // フォロー解除
    Route::post('/follow.follow', 'UsersController@follow')->name('follow.follow'); // フォロー機能

    Route::get('/follow-list', 'PostsController@followList')->name('follow.list'); // フォローしているユーザーの投稿を表示
    Route::post('/follow-list', 'UsersController@followList');

    Route::get('/follower-list', 'FollowsController@followerList')->name('follower.list'); // フォロワーユーザーのリスト表示
    Route::post('/follower-list', 'FollowsController@followerList');

    Route::get('logout', 'Auth\LoginController@logout')->name('logout'); // ログアウト
});
