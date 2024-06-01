@extends('layouts.login')

@section('content')
<div class="container">
  <h2>プロフィール編集</h2>

  <div class="row justify-content-center">
    <div class="col-md-8">
      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="username">ユーザー名</label>
          <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
        </div>

        <div class="form-group">
          <label for="mail">メールアドレス</label>
          <input type="email" class="form-control" id="mail" name="mail" value="{{ old('mail', $user->mail) }}" required>
        </div>

        <div class="form-group">
          <label for="password">パスワード</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="新しいパスワード">
        </div>

        <div class="form-group">
          <label for="password_confirmation">パスワード確認</label>
          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="新しいパスワード確認">
        </div>

        <div class="form-group">
          <label for="bio">自己紹介</label>
          <textarea class="form-control" id="bio" name="bio" rows="3">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <div class="form-group">
          <label for="images">アイコン画像</label>
          <input type="file" class="form-control-file" id="images" name="images">
            @if($user->images)
              <img src="{{ asset('storage/images/' . $user->images) }}" alt="アイコン画像" class="mt-2" width="100">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">更新する</button>
      </form>
    </div>
  </div>
</div>
@endsection
