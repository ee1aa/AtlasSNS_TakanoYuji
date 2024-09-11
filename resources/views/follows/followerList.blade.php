@extends('layouts.login')

@section('content')
<div class="follow-container">
  <div class="follow-list">
    <h2 class="follow-title">フォロワーリスト</h2>
    <div class="user-row">
      <!-- フォローしているユーザーのアイコンを表示 -->
      @if(isset($followers) && count($followers) > 0)
        @foreach ($followers as $follower)
          <div class="user">
            <a href="{{ route('profile.show', ['user' => $follower->id]) }}">
              @if($follower->images)
                <img src="{{ asset('storage/images/' . $follower->images) }}" alt="ユーザーアイコン" class="list-icon">
              @else
                <img src="{{ asset('images/icon1.png') }}" alt="デフォルトアイコン" class="list-icon">
              @endif
            </a>
          </div>
        @endforeach
      @else
        <p>フォローしているユーザーはいません。</p>
      @endif
    </div>
  </div>


  <div class="follow_post mt-5">
    <div class="index">
      @if(isset($posts) && count($posts) > 0)
        @foreach($posts as $post)
          <div class="follow-post">
            <div class="user-icon">
              <a href="{{ route('profile.show', ['user' => $follower->id]) }}">
                @if($follower->images)
                  <img src="{{ asset('storage/images/' . $follower->images) }}" alt="ユーザーアイコン" class="list-icon">
                @else
                  <img src="{{ asset('images/icon1.png') }}" alt="デフォルトアイコン" class="list-icon">
                @endif
              </a>
            </div>
            <div class="name-post">
              <p>{{ $post->user->username }}</p>
              <p>{!! nl2br(e($post->post)) !!}</p>
            </div>
            <div class="created-buttons">
              <p>{{ $post->created_at->format('Y-m-d H:i') }}</p>
            </div>
          </div>
        @endforeach
      @else
        <p>フォロー中のユーザーの投稿はありません。</p>
      @endif
    </div>
  </div>
</div>
@endsection
