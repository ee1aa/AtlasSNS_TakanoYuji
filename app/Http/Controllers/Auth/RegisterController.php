<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

//RegisterFormRequestを使用
use App\Http\Requests\RegisterFormRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    //ユーザー新規登録処理　=post処理
    public function register(RegisterFormRequest $request){
        if($request->isMethod('post')){
            //postの処理 入力した値を取得する
            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            //postの処理 送信後に各データを格納する
            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);

            //セッションへデータを保存する
            $request->session()->put('username', $username);

            //セッションを使用してユーザー名を表示させる
            return redirect('registerCreate')->with('username', $username);
        }

        return view('auth.register');

    }

    public function registerView()
    {
        //getの処理
        return view('auth.register');
    }

    public function added()
    {
        return view('auth.added');
    }
}
