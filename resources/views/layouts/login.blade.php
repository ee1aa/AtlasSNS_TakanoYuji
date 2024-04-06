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
    <script src="js/script.js"></script>
</head>
<body>
    <header>
        <div id = "head">
            <h1 class="logo"><a href="{{ route('/top') }}"><img src="images/atlas.png" alt="ロゴ"></a></h1>
            <div class="nav-open">
                <p class="username">{{ Auth::user()->username }}さん</p>
                <nav class="accordion">
                    <div class="menu-trigger">
                        <p>></p>
                    </div>
                </nav>
                <nav class="g-navi">
                    <div class="container nav-wrapper">
                        <ul>
                            <li class="nav-item active"><a class="nav-link" href="{{ route('/top') }}">HOME</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">プロフィール編集</a></li>
                            <li class="nav-item"><a class="nav-link" href="/logout">ログアウト</a></li>
                        </ul>
                    </div>
                </nav>
                <div class="icon">
                    <img src="{{ asset('images/icon1.png') }}">
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
                <p>{{ session('username') }}さんの</p>
                <div>
                <p>フォロー数</p>
                <p>〇〇名</p>
                </div>
                <p class="btn"><a href="">フォローリスト</a></p>
                <div>
                <p>フォロワー数</p>
                <p>〇〇名</p>
                </div>
                <p class="btn"><a href="">フォロワーリスト</a></p>
            </div>
            <p class="btn"><a href="">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <!-- Bootstrap JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
