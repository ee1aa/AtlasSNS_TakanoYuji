@extends('layouts.login')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="edit-mode-icon">
        @if(Auth::user()->images)
          <img src="{{ asset('storage/images/' . Auth::user()->images) }}" alt="{{ Auth::user()->username }}">
        @else
          <img src="{{ asset('images/icon1.png') }}" alt="デフォルトアイコン">
        @endif
      </div>
      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="username">ユーザー名</label>
          <input type="text" class="edit-form" id="username" name="username" value="{{ old('username', $user->username) }}" required>
        </div>

        <div class="form-group">
          <label for="mail">メールアドレス</label>
          <input type="email" class="edit-form" id="mail" name="mail" value="{{ old('mail', $user->mail) }}" required>
        </div>

        <div class="form-group">
          <label for="password">パスワード</label>
          <input type="password" class="edit-form" id="password" name="password" placeholder="新しいパスワード">
        </div>

        <div class="form-group">
          <label for="password_confirmation">パスワード確認</label>
          <input type="password" class="edit-form" id="password_confirmation" name="password_confirmation" placeholder="新しいパスワード確認">
        </div>

        <div class="form-group">
          <label for="bio">自己紹介</label>
          <textarea class="edit-form" id="bio" name="bio" rows="3">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <div class="form-group">
          <label for="images">アイコン画像</label>
          <input type="file" class="edit-form-file" id="images" name="images">
            @if($user->images)
              <img src="{{ asset('storage/images/' . $user->images) }}" alt="アイコン画像" class="mt-2" width="100">
            @endif
        </div>

        <button type="submit" class="btn edit-btn">更新する</button>
      </form>
    </div>
  </div>
</div>
@endsection
