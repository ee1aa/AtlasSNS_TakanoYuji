@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>
<div class="post-form container">
  {!! Form::open(['url' => '/postCreate']) !!}
  {{Form::token()}}
  <div class="form-group">
    <img src="{{ asset('images/icon1.png') }}">
    {!! Form::input('text', 'post', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) !!}
  </div>
  <button type="submit" class="post-btn btn-success pull-right"><img src="images/post.png" alt="投稿" width="25px" height="25px"></button>
  {!! Form::close() !!}
</div>
<div class="index">
  @foreach ($posts as $post)
  <tr>
    <!-- $変数->テーブル->カラム or $controller定数->カラム -->
    <td>{{ $post->user->images }}</td>
    <td>{{ $post->user->username }}</td>
    <td>{{ $post->post }}</td>
    <td>{{ $post->created_at }}</td>
    <td><a class="js-modal-open" href="" post="{{ $post->post }}" post_id="{{ $post->id }}"><img src="images/edit.png" alt="編集" width="25px" height="25px"></a></td>
    <td><a class="btn btn-danger" href="" post="{{ $post->post }}" post_id="{{ $post->id }}" onclick="confirmDelete('{{ $post->post }}')"><img src="images/trash.png" alt="削除" width="25px" height="25px"></a></td>
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
    <input type="hidden" name="post_id" value="{{ $post->id }}">
  </form>
  <script>
    function confirmDelete(post) {
        if (confirm(`こちらの投稿を削除してもよろしいでしょうか？\n投稿内容：${post}`)) {
            document.getElementById('delete-post-form').submit();
        }
    }
  </script>
</div>
@endsection
