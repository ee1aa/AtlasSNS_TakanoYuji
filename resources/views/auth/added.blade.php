@extends('layouts.logout')

@section('content')

<div class="box">
  <div class="welcome">
    <p>{{ session('username') }}さん</p>
    <p>ようこそ！ AtlasSNSへ</p>
  </div>
  <div class="clear">
    <p>ユーザー登録が完了いたしました。</p>
    <p>早速ログインをしてみましょう！</p>
  </div>
  <div class="center-btn">
    <a class="login-btn" href="{{ asset('/login') }}">ログイン画面へ</a>
  </div>
</div>

@endsection
