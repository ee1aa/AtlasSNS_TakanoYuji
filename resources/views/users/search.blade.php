@extends('layouts.login')

@section('content')
<div class="search-container">
  <form action="/search" method="post">
    @csrf
    <input type="text" name="keyword" class="form" placeholder="検索">
    <button type="submit" class="btn btn-success"><img src="images/search.png" alt="検索" width="25px" height="25px"></button>
  </form>
</div>
<div class="user-list">
  @foreach ($users as $user)
  @if($user->id !== Auth::user()->id)
  <tr>
    <td>{{ $user->images }}</td>
    <td>{{ $user->username }}</td>
  </tr>
  <br>
  @endif
  @endforeach
</div>


@endsection
