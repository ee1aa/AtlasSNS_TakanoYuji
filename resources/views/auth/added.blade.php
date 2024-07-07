@extends('layouts.logout')

@section('content')

<div class="box">
  <div class="welcome">
    <p class="welcome-text">{{ session('username') }}さん<br>ようこそ！ AtlasSNSへ</p>
  </div>
  <div class="clear">
    <p class="clear-text">ユーザー登録が完了いたしました。<br>早速ログインをしてみましょう！</p>
  </div>
  <div class="center-btn">
    <a class="login-btn" href="{{ asset('/login') }}">ログイン画面へ</a>
  </div>
</div>

@endsection
