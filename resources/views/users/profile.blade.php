@extends('layouts.login')

@section('content')
<div class="container">
  <div class="profile">
    <div class="profile-header">
      <img src="{{ asset('storage/images/' . $user->images) }}" alt="ユーザーアイコン" class="profile-icon">
      <h2>ユーザー名</h2>
      <h2>{{ $user->username }}</h2>
    </div>
    <div class="profile-bio">
      <p>自己紹介</p>
      <p>{{ $user->bio }}</p>
    </div>
    <div class="follow-btn">
      @if (Auth::user()->followCheck($user->id))
        <form action="/follow.unfollow" method="post">
          @csrf
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <button type="submit" class="btn btn-primary">フォロー解除</button>
        </form>
      @else
        <form action="/follow.follow" method="post">
          @csrf
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <button type="submit" class="btn btn-primary">フォローする</button>
        </form>
      @endif
    </div>
  </div>
  <h3>投稿一覧</h3>
  @if($posts->isEmpty())
    <p>投稿がありません。</p>
  @else
    <div class="posts-list">
      @foreach($posts as $post)
        <div class="post-header">
          <img src="{{ $user->images ? asset('storage/images/' . $user->images) : asset('icon1.png') }}" alt="ユーザーアイコン" width="20px" height="20px">
          <div class="post-info">
            <p>{{ $user->username }}</p>
            <p>{{ $post->created_at->format('Y-m-d H:i') }}</p>
          </div>
        </div>
        <div class="post-content">
          <p>{{ $post->post }}</p>
        </div>
      @endforeach
    </div>
  @endif
</div>
@endsection
