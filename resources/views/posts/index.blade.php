@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>
<div class="post-form container">
  {!! Form::open(['url' => '/top']) !!}
  {{Form::token()}}
  <div class="form-group">
    <img src="{{ asset('images/icon1.png') }}">
    {!! Form::input('text', 'post', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) !!}
  </div>
  <button type="submit" class="btn btn-success pull-right"><img src="images/post.png" alt="投稿" width="15%" height="15%"></button>
  {!! Form::close() !!}
</div>

@endsection
