@extends('layouts.login')

@section('content')
<div class="container">
    <div class="profile">
        <div class="profile-header">
            <img src="{{ asset('storage/images/' . $user->images) }}" alt="ユーザーアイコン" class="profile-icon">
            <h2>{{ $user->username }}</h2>
        </div>
        <div class="profile-bio">
            <p>{{ $user->bio }}</p>
        </div>
    </div>
</div>
@endsection
