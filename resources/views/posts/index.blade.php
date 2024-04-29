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
  <button type="submit" class="btn btn-success pull-right"><img src="images/post.png" alt="投稿" width="15%" height="15%"></button>
  {!! Form::close() !!}
</div>
<div class="index">
  @foreach ($posts as $post)
  <tr>
    <!-- $as変数->テーブル->カラム or $controller定数->カラム -->
    <td>{{ $post->user->images }}</td>
    <td>{{ $post->user->username }}</td>
    <td>{{ $post->post }}</td>
    <td>{{ $post->created_at }}</td>
  </tr>
  <br>
  @endforeach
</div>
@endsection
