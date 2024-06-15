@extends('layouts.login')

@section('content')

<div class="container">

  <h2>フォロワーリスト</h2>

  <div class="row">

    <!-- フォロワーユーザーのアイコンを表示 -->

    @if(isset($followers) && count($followers) > 0)

      @foreach ($followers as $follower)

        <div class="user">

          <a href="{{ route('profile.show', ['user' => $follower->id]) }}">

            <img src="{{ $follower->images ? asset('storage/images/' . $follower->images) : asset('icon1.png') }}" alt="ユーザーアイコン" width="20" height="20">

          </a>

        </div>

      @endforeach

    @else

      <p>フォローしているユーザーはいません。</p>

    @endif

  </div>


  <div class="follow_post mt-5">

    <h3>フォロワーユーザーの投稿</h3>

    <div class="row">

      @if(isset($posts) && count($posts) > 0)

        @foreach($posts as $post)

          <div class="col-md-4 mb-3">

            <div class="card">

              <div class="card-body">

                <div class="d-flex align-items-center mb-3">

                  <a href="{{ route('profile.show', ['user' => $post->user->id]) }}">

                    <img src="{{ $post->user->images ? asset('storage/images/' . $post->user->images) : asset('icon1.png') }}" alt="ユーザーアイコン" width="20" height="20">

                  </a>

                  <p>{{ $post->user->username }}</p>

                </div>

                <p>{{ $post->post }}</p>

                <p>{{ $post->created_at->format('Y-m-d H:i') }}</p>

              </div>

            </div>

          </div>

        @endforeach

      @else

        <p>投稿がありません。</p>

      @endif

    </div>

  </div>

</div>

@endsection
