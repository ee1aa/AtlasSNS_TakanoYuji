@extends('layouts.login')

@section('content')
<div class="post-form-container">
  <div class="form-group">
    <div class="user-form">
      @if($user->images)
        <img src="{{ asset('storage/images/' . $user->images) }}" alt="{{ $user->username }}のアイコン" class="list-icon">
      @else
        <img src="{{ asset('images/icon1.png') }}" alt="デフォルトアイコン" class="list-icon">
      @endif
    </div>
    <div class="profile-column form-control">
      <div class="profile-header">
        <p>ユーザー名　　　　</p>
        <p>{{ $user->username }}</p>
      </div>
      <div class="profile-bio">
        <p>自己紹介　　　　　</p>
        <p>{{ $user->bio }}</p>
      </div>
    </div>
    <div class="follow-unfollow right-under">
      @if (Auth::user()->followCheck($user->id))
        <form action="/follow.unfollow" method="post">
          @csrf
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <button type="submit" class="btn btn-primary undo-follow post-btn">フォロー解除</button>
        </form>
      @else
        <form action="/follow.follow" method="post">
          @csrf
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <button type="submit" class="btn btn-primary do-follow post-btn">フォローする</button>
        </form>
      @endif
    </div>
  </div>
</div>

<div class="index">
  @foreach ($posts as $post)
  <div class="post">
    <!-- $変数->テーブル->カラム or $controller定数->カラム -->
    <div class="user-icon">
      @if($post->user->images)
        <img src="{{ asset('storage/images/' . $post->user->images) }}" class="post-icon" alt="{{ $post->user->username }}">
      @else
        <img src="{{ asset('images/icon1.png') }}" class="post-icon" alt="デフォルトアイコン">
      @endif
    </div>
    <div class="name-post">
      <p>{{ $post->user->username }}</p>
      <p>{!! nl2br(e($post->post)) !!}</p>
    </div>
    <div class="created-buttons">
      <p>{{ $post->created_at->format('Y-m-d H:i') }}</p>
    </div>
  </div>
  <br>
  @endforeach
</div>
@endsection
