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

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\Auth\LoginController;
use app\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FollowsController;

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
    Route::post('/top', [PostsController::class, 'index']);
    Route::get('/top', [PostsController::class, 'index']);

    Route::post('/profile', [UsersController::class, 'profile']);
    Route::get('/profile', [UsersController::class, 'profile']);

    Route::post('/search', [UsersController::class, 'search']);
    Route::get('/search', [UsersController::class, 'search']);

    Route::post('/follow-list', [FollowsController::class, 'followList']);
    Route::get('/follow-list', [FollowsController::class, 'followList']);

    Route::post('/follower-list', [FollowsController::class, 'followerList']);
    Route::get('/follower-list', [FollowsController::class, 'followerList']);
});

// Route::post('/top','PostsController@index');

// Route::get('/profile','UsersController@profile');

// Route::get('/search','UsersController@index');

// Route::get('/follow-list','PostsController@index');
// Route::get('/follower-list','PostsController@index');

// Atlasロゴにトップページへ遷移するリンクを設置する
Route::get('/top', function () {
    return view('posts.index');
})->name('/top');
