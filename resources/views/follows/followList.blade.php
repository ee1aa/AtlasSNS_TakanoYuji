@extends('layouts.login')

@section('content')
<div class="follow-container">
  <div class="follow-list">
    <h2>フォローリスト</h2>
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
    <h3>フォロー中のユーザーの投稿</h3>
    <div class="post-list">
      @if(isset($posts) && count($posts) > 0)
        @foreach($posts as $post)
          <div class="col-md-4 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <a href="{{ route('profile.show', ['user' => $following->id]) }}">
                    <img src="{{ asset('storage/images/' . $following->images) }}" alt="ユーザーアイコン" width="20" height="20">
                  </a>
                  <h5 class="card-title mb-0">{{ $post->user->username }}</h5>
                </div>
                <p class="card-text">{{ $post->post }}</p>
                <p class="text-muted">{{ $post->created_at->format('Y-m-d H:i') }}</p>
              </div>
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
