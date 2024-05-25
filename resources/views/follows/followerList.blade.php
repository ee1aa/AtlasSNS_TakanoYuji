@extends('layouts.login')

@section('content')

<!-- フォローしているユーザーのアイコン一覧 -->
<div class="">
  <!-- タイトル -->
  <h2>Follow List</h2>
  @foreach ($follows as $follow)
  <ul>
    <li>
      <!-- アイコン一覧本体 -->
      <div class="follow_icon">
        <button type="button"><img src="{{ asset('storage/images'.$follow->user->images) }}" alt="ユーザーアイコン"></button>
      </div>
    </li>
  </ul>
  @endforeach
</div>

@endsection
