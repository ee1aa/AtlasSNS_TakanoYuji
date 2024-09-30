@extends('layouts.logout')

@section('content')

<!-- バリデーションメッセージ -->
@if ($errors->any())
<div class="register_error">
  <ul>
    @foreach ($errors->all() as $error)
    <li class="error-massage">{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<!-- 適切なURLを入力してください -->
<!-- postで送ってpostで受け取る -->
{!! Form::open(['url' => '/register', 'method' => 'post']) !!}
<div class="box">
  {{ csrf_field() }}
  <h2>新規ユーザー登録</h2>
  <div class="form-group">
    {{ Form::label('ユーザー名', null, ['class' => 'label']) }}
    {{ Form::text('username',null,['class' => 'input']) }}
    {{ Form::label('メールアドレス', null, ['class' => 'label']) }}
    {{ Form::text('mail', null, ['class' => 'input']) }}
    {{ Form::label('パスワード', null, ['class' => 'label']) }}
    {{ Form::password('password', ['class' => 'input']) }}
    {{ Form::label('パスワード確認', null, ['class' => 'label']) }}
    {{ Form::password('password_confirmation',['class' => 'input']) }}
    <div class="text-right">
      {{ Form::submit('新規登録', ['class' => 'btn btn-danger']) }}
    <div class="text-right">
    <p><a class="register" href="{{ asset('/login') }}">ログイン画面へ戻る</a></p>
  </div>
</div>
{!! Form::close() !!}


@endsection
