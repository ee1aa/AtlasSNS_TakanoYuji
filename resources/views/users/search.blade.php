@extends('layouts.login')

@section('content')
<div class="search-container">
  <form action="/search" method="post">
    @csrf
    <input type="text" name="keyword" class="form" placeholder="検索">
    <button type="submit" class="btn btn-success"><img src="images/search.png" alt="検索" width="25px" height="25px"></button>
  </form>
  <div class="search-keyword">
    @if(!empty($keyword))
    <p>検索ワード：{{ $keyword }}</p>
    @endif
  </div>
</div>
<div class="user-list">
  @foreach ($users as $user)
  @if($user->id !== Auth::user()->id)
  <tr>
    <td>{{ $user->images }}</td>
    <td>{{ $user->username }}</td>
    <td>
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
    </td>
  </tr>
  <br>
  @endif
  @endforeach
</div>


@endsection
