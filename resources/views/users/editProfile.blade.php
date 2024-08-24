@extends('layouts.login')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="edit-mode">
      <div class="edit-mode-icon">
        @if(Auth::user()->images)
          <img src="{{ asset('storage/images/' . Auth::user()->images) }}" alt="{{ Auth::user()->username }}">
        @else
          <img src="{{ asset('images/icon1.png') }}" alt="デフォルトアイコン">
        @endif
      </div>
      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="edit-group">
        @csrf
        <div class="edit-total">
          <div class="label-group">
            <label for="username">ユーザー名</label>
            <label for="mail">メールアドレス</label>
            <label for="password">パスワード</label>
            <label for="password_confirmation">パスワード確認</label>
            <label for="bio">自己紹介</label>
            <label for="images">アイコン画像</label>
          </div>
          <div class="edit-form-group">
            <input type="text" class="edit-form" id="username" name="username" value="{{ old('username', $user->username) }}" required>
            <input type="email" class="edit-form" id="mail" name="mail" value="{{ old('mail', $user->mail) }}" required>
            <input type="password" class="edit-form" id="password" name="password" placeholder="新しいパスワード">
            <input type="password" class="edit-form" id="password_confirmation" name="password_confirmation" placeholder="新しいパスワード確認">
            <textarea class="edit-form" id="bio" name="bio" rows="3">{{ old('bio', $user->bio) }}</textarea>
            <input type="file" class="edit-form-file" id="images" name="images">
              @if($user->images)
                <img src="{{ asset('storage/images/' . $user->images) }}" alt="アイコン画像" class="mt-2" width="100">
              @endif
            <label type="file" id="images" name="images" for="images" class="image-box">ファイルを選択</label>
          </div>
        </div>
        <button type="submit" class="btn edit-btn">更新</button>
      </form>
    </div>
  </div>
</div>
@endsection
