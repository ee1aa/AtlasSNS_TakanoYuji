@extends('layouts.login')

@section('content')
<div class="post-form-container">
  {!! Form::open(['url' => '/postCreate']) !!}
  {{Form::token()}}
  <div class="form-group">
    <div class="user-form">
      @if(Auth::user()->images)
        <img src="{{ asset('storage/images/' . Auth::user()->images) }}" alt="ユーザーアイコン">
      @else
        <img src="{{ asset('storage/images/icon1.png') }}" alt="デフォルトアイコン">
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
  <tr class="post">
    <!-- $変数->テーブル->カラム or $controller定数->カラム -->
    <td><img src="{{ asset('storage/images/' . $post->user->images) }}" class="post-icon" alt="{{ $post->user->username }}"></td>
    <td>{{ $post->user->username }}</td>
    <br>
    <td>{!! nl2br(e($post->post)) !!}</td>
    <td>{{ $post->created_at }}</td>
    @if(Auth::id() == $post->user_id)
      <td><a class="js-modal-open" href="" post="{{ $post->post }}" post_id="{{ $post->id }}"><img src="images/edit.png" alt="編集" width="20px" height="20px"></a></td>
      <td><button class="btn btn-danger delete-button" action="/post/delete" data-post="{{ $post->post }}" data-post_id="{{ $post->id }}" onclick="event.preventDefault(); confirmDelete('{{ $post->post }}', '{{ $post->id }}')"></button></td>
    @endif
  </tr>
  <br>
  @endforeach
  <!-- 編集モーダルの中身 -->
  <div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
      <form action="/post/update" method="post">
        <textarea name="upPost" class="modal_post"></textarea>
        <input type="hidden" name="id" class="modal_id" value="">
        <input type="submit" value="更新">
        {{ csrf_field() }}
      </form>
      <a class="js-modal-close" href="">閉じる</a>
    </div>
  </div>
  <!-- 削除モーダルの中身 -->
  <form id="delete-post-form" action="/post/delete" method="post">
    @csrf
    <input class="delete-id" type="hidden" name="post_id" value="">
  </form>
</div>
@endsection
