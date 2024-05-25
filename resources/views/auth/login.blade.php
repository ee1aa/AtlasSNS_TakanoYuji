@extends('layouts.logout')

@section('content')
<!-- 'url' => web.php参照 -->
{!! Form::open(['url' => '/login']) !!}

<p>AtlasSNSへようこそ</p>
@csrf
{{ Form::label('e-mail') }}
{{ Form::text('mail',null,['class' => 'input']) }}
{{ Form::label('password') }}
{{ Form::password('password',['class' => 'input']) }}

{{ Form::submit('ログイン') }}

<p><a href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}

@endsection
