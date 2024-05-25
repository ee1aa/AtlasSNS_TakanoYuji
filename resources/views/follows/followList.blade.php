@extends('layouts.login')

@section('content')

<div class="container">

  <h2>フォローリスト</h2>

  <div class="row">

    @foreach ($followings as $following)
      <div class="">
        <div class="">
          <img src="{{ asset('images/' . $following->images) }}" class="card-img-top" alt="{{ $following->username }}">
        </div>
      </div>
    @endforeach

  </div>

</div>

@endsection
