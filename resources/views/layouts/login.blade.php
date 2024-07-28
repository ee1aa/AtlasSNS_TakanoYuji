<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</head>
<body>
    <header>
        <div id="head">
            <h1 class="logo"><a href="{{ asset('/top') }}"><img src="{{ asset('images/atlas.png') }}" alt="ロゴ" width="30%" height="30%"></a></h1>
            <div class="nav-open">
                <p class="username">{{ Auth::user()->username }}　さん</p>
                <nav class="accordion">
                    <div class="menu-trigger">
                        <p>></p>
                    </div>
                </nav>
                <div class="icon">
                    @if(Auth::user()->images)
                        <img src="{{ asset('storage/images/' . Auth::user()->images) }}" alt="ユーザーアイコン">
                    @else
                        <img src="{{ asset('images/icon1.png') }}" alt="デフォルトアイコン">
                    @endif
                </div>
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <nav class="g-navi">
                    <div class="container nav-wrapper">
                        <ul>
                            <li class="nav-item active"><a class="nav-link" href="/top">HOME</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">プロフィール編集</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">ログアウト</a></li>
                        </ul>
                    </div>
                </nav>
                <div class="follow">
                    <p>{{ Auth::user()->username }}さんの</p>
                    <p>フォロー数　　　{{ Auth::user()->follow_count }}人</p>
                    <div class="text-right">
                        <a class="follow-btn" href="{{ route('follow.list') }}">フォローリスト</a>
                    </div>
                    <p>フォロワー数　　{{ Auth::user()->follower_count }}人</p>
                    <div class="text-right">
                        <a class="follow-btn" href="{{ route('follower.list') }}">フォロワーリスト</a>
                    </div>
                </div>
            </div>
            <div class="search-container">
                <a class="search-btn" href="{{ asset('/search') }}">ユーザー検索</a>
            </div>
        </div>
    </div>
    <footer>
    </footer>
</body>
<html>
