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
use App\Http\Controllers\PostsController;

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
Route::middleware(['web', 'auth'])->group(function () {
    // ここにauthミドルウェアが適用されるルートを定義する
    Route::post('/top', 'PostsController@index');
    Route::get('/top', 'PostsController@index');

    Route::post('/top', 'PostsController@postCreate');

    Route::post('/profile', 'UsersController@profile');
    Route::get('/profile', 'UsersController@profile')->name('profile');

    Route::post('/search', 'UsersController@search');
    Route::get('/search', 'UsersController@search');

    Route::get('/show', 'FollowsController@show');

    Route::post('/follow-list', 'FollowsController@followList');
    Route::get('/follow-list', 'FollowsController@followList');

    Route::post('/follower-list', 'FollowsController@followerList');
    Route::get('/follower-list', 'FollowsController@followerList');

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    // Atlasロゴにトップページへ遷移するリンクを設置する
    Route::get('/top', function () {
    return view('posts.index');
    })->name('/top');
});
