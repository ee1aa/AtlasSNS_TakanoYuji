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

// ログアウト中のページ

// ログイン
// ログインフォーム表示
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
// ログイン処理
Route::post('/login', 'Auth\LoginController@login');

// ユーザー登録
// ユーザー登録フォーム表示
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// ユーザー登録処理
Route::post('/register', 'Auth\RegisterController@register');

// 登録完了
// 登録完了ページ表示
Route::get('/added', 'Auth\RegisterController@added')->name('added');


//ログイン中のページ
// ミドルウェアを使用して複数のルートに適用する
//ログイン中のページ
Route::middleware(['web', 'auth'])->group(function () {
    // ホームページ
    Route::get('/top', 'PostsController@index')->name('top');

    // 投稿機能
    Route::post('/postCreate', 'PostsController@postCreate')->name('post.create');

    // 編集機能
    Route::post('/post/update', 'PostsController@postUpdate')->name('post.update');

    // 削除機能
    Route::post('/post/delete', 'PostsController@postDelete')->name('post.delete');

    // プロフィール編集ページ
    Route::get('/profile/edit', 'UsersController@editProfile')->name('profile.edit');
    Route::post('/profile/update', 'UsersController@updateProfile')->name('profile.update');

    // ユーザー検索
    Route::post('/search', 'UsersController@search')->name('search');
    Route::get('/search', 'UsersController@search')->name('search');

    // フォロー解除
    Route::post('/follow.unfollow', 'UsersController@unfollow')->name('follow.unfollow');

    // フォロー機能
    Route::post('/follow.follow', 'UsersController@follow')->name('follow.follow');

    // フォローしているユーザーの投稿を表示
    Route::get('/follow-list', 'PostsController@followList')->name('follow.list');
    Route::post('/follow-list', 'UsersController@followList');

    //アイコンをクリックしてそのユーザのプロフィールへ飛ぶルート
    Route::get('/profile/{user}', 'UsersController@profile')->name('profile.show');

    //プロフィールページで投稿を表示する
    Route::get('/profile/{user}', 'UsersController@showProfile')->name('profile.show');

    // フォロワーユーザーのリスト表示
    Route::get('/follower-list', 'FollowsController@followerList')->name('follower.list');
    Route::post('/follower-list', 'FollowsController@followerList');

    // ログアウト
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
});
