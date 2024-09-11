@extends('layouts.login')

@section('content')
<div class="follow-container">
  <div class="follow-list">
    <h2 class="follow-title">フォローリスト</h2>
    <div class="user-row">
      <!-- フォローしているユーザーのアイコンを表示 -->
      @if(isset($followings) && count($followings) > 0)
        @foreach ($followings as $following)
          <div class="user">
            <a href="{{ route('profile.show', ['user' => $following->id]) }}">
              @if($following->images)
                <img src="{{ asset('storage/images/' . $following->images) }}" alt="ユーザーアイコン" class="list-icon">
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
              <a href="{{ route('profile.show', ['user' => $following->id]) }}">
                @if($following->images)
                  <img src="{{ asset('storage/images/' . $following->images) }}" alt="ユーザーアイコン" class="list-icon">
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
