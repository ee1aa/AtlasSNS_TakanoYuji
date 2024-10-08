@extends('layouts.login')

@section('content')
<div class="post-form-container">
  {!! Form::open(['url' => '/postCreate']) !!}
  {{Form::token()}}
  <div class="form-group">
    <div class="user-form">
      @if(Auth::user()->images)
        <img src="{{ asset('storage/images/' . Auth::user()->images) }}" alt="{{ Auth::user()->username }}">
      @else
        <img src="{{ asset('images/icon1.png') }}" alt="デフォルトアイコン">
      @endif
    </div>
    {!! Form::textarea('post', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください。', 'rows' => 5]) !!}
    <div class="right-under">
      <button type="submit" class="post-btn btn-success pull-right"><img src="images/post.png" alt="投稿" ></button>
    </div>
    {!! Form::close() !!}
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
    <div class="buttons">
      @if(Auth::id() == $post->user_id)
        <a class="js-modal-open" href="" post="{{ $post->post }}" post_id="{{ $post->id }}"><img src="images/edit.png" alt="編集" width="50px" height="50px"></a>
        <button class="btn btn-danger delete-button" action="/post/delete" data-post="{{ $post->post }}" data-post_id="{{ $post->id }}" onclick="event.preventDefault(); confirmDelete('{{ json_encode($post->post) }}', '{{ $post->id }}')"></button>
      @endif
    </div>
  </div>
  <br>
  @endforeach
  <!-- 編集モーダルの中身 -->
  <div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
      <form action="/post/update" method="post">
        {!! Form::textarea('post', null, ['required', 'class' => 'modal_post', 'name' => 'upPost', 'placeholder' => '投稿内容を入力してください。', 'rows' => 5]) !!}
        <input type="hidden" name="id" class="modal_id" value="">
        <!-- この下に編集ボタンの画像を入れる。ホバー時削除ボタンの面取り -->
        <div class="center-center">
          <button type="submit" class="edit-check"><img class="edit-check-img" src="images/edit.png" alt="編集" ></button>
        </div>
        {{ csrf_field() }}
      </form>
    </div>
  </div>
  <!-- 削除モーダルの中身 -->
  <form id="delete-post-form" action="/post/delete" method="post">
    @csrf
    <input class="delete-id" type="hidden" name="post_id" value="">
  </form>
</div>
@endsection
