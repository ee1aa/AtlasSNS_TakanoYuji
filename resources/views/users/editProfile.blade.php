@extends('layouts.login')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="edit-mode">
      <div class="edit-mode-icon">
        @if(Auth::user()->images)
          <img src="{{ asset('storage/images/' . Auth::user()->images) }}" class="post-icon" alt="{{ Auth::user()->username }}">
        @else
          <img src="{{ asset('images/icon1.png') }}" class="post-icon" alt="デフォルトアイコン">
        @endif
      </div>
      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="edit-group">
        @csrf
        <div class="edit-total">
          <div class="little-total">
            <div class="edit-style">
              <label for="username">ユーザー名　　</label>
              <input type="text" class="edit-form" id="username" name="username" value="{{ old('username', $user->username) }}" minlength="2" maxlength="12" required>
              @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="edit-style">
              <label for="mail">メールアドレス</label>
              <input type="email" class="edit-form" id="mail" name="mail" value="{{ old('mail', $user->mail) }}" minlength="5" maxlength="40" email required>
              @error('mail')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="edit-style">
              <label for="password">パスワード　　</label>
              <input type="password" class="edit-form" id="password" name="password" placeholder="新しいパスワード" autocomplete="new-password" minlength="8" maxlength="20" pattern="[a-zA-Z0-9]+" required>
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="edit-style">
              <label for="password_confirmation">パスワード確認</label>
              <input type="password" class="edit-form" id="password_confirmation" name="password_confirmation" placeholder="新しいパスワード確認" minlength="8" maxlength="20" pattern="[a-zA-Z0-9]+" required>
              @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="edit-style">
              <label for="bio">自己紹介　　　</label>
              <input type="text" class="edit-form" id="bio" name="bio" value="{{ old('bio', $user->bio) }}" string maxlength="150">
              @error('bio')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="edit-style select-icon">
              <label>アイコン画像　</label>
              <input type="file" class="edit-form-file" id="images" name="images" style="display:none" accept="image/png, image/jpg, image/jpeg, image/bmp, image/gif, image/svg+xml">
              <label type="file" id="images" name="images" for="images" class="image-box">ファイルを選択</label>
              @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
        <button type="submit" class="btn edit-btn">更新</button>
      </form>
    </div>
  </div>
</div>
@endsection
