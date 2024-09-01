@extends('layouts.login')

@section('content')
<div class="search-page">
  <div class="search-area">
    <form action="/search" method="post" class="search-form">
      @csrf
      <input type="text" name="keyword" class="form" placeholder="ユーザー名">
      <button type="submit" class="btn btn-success look-for">
        <img src="images/search.png" alt="検索" class="lf-image">
      </button>
    </form>
  </div>
  <div class="search-keyword">
    @if(!empty($keyword))
    <p>検索ワード：{{ $keyword }}</p>
    @endif
  </div>
</div>
<div class="user-list">
  @foreach ($users as $user)
  @if($user->id !== Auth::user()->id)
  <div class="user-flex">
    <div>
      @if($user->images)
        <img src="{{ asset('storage/images/' . $user->images) }}" alt="{{ $user->username }}のアイコン" class="list-icon">
      @else
        <img src="{{ asset('images/icon1.png') }}" alt="デフォルトアイコン" class="list-icon">
      @endif
    </div>
    <div>{{ $user->username }}</div>
    <div class="follow-unfollow">
      @if (Auth::user()->followCheck($user->id))
        <form action="/follow.unfollow" method="post">
          @csrf
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <button type="submit" class="btn btn-primary undo-follow">フォロー解除</button>
        </form>
      @else
        <form action="/follow.follow" method="post">
          @csrf
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <button type="submit" class="btn btn-primary do-follow">フォローする</button>
        </form>
      @endif
    </div>
  </div>
  <br>
  @endif
  @endforeach
</div>
@endsection
