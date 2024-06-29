@extends('layouts.logout')

@section('content')
<!-- 'url' => web.php参照 -->
{!! Form::open(['url' => '/login']) !!}
<div class="box">
  <p>AtlasSNSへようこそ</p>
  @csrf
  <div class="form-group">
    {{ Form::label('メールアドレス', null, ['class' => 'label']) }}
    {{ Form::text('mail', null, ['class' => 'input']) }}
    {{ Form::label('パスワード', null, ['class' => 'label']) }}
    {{ Form::password('password', ['class' => 'input']) }}
    <div class="text-right">
      {{ Form::submit('ログイン', ['class' => 'btn btn-danger']) }}
    </div>
    <p><a class="register" href="{{ asset('/register') }}">新規ユーザーの方はこちら</a></p>
  </div>
</div>
{!! Form::close() !!}

@endsection
