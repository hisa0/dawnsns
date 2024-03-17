<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/style.css">
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
    <script src="http://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="/js/script.js"></script>

</head>
<!-- ログイン時TOPページ -->
<body>
<header>
<div id = "head">
        <div class="header_logo">
            <h1><a href="/index"><img src="/images/main_logo.png"></a></h1>
        </div>
    <div class="header-menu">
            <div class="header_name">
                    <p>{{ Auth::user()->username }}さん</p>
            </div>
            <div class="header_list">
                <input type="checkbox" id="acd_id">
                <label for="acd_id"></label>
                    <ul id="acd_ul">
                        <li><a href="/top">HOME</a></li>
                        <li><a href="/profile">プロフィール編集</a></li>
                        <li><a href="/logout">ログアウト</a></li>
                    </ul>
        </div>
        <div class="header-icon">
                    <a href="#"><img src="/storage/images/{{ Auth::user()->images }}" class= "user_icon header_user_icon"></a>
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
                            <p class="username">{{ Auth::user()->username }}さんの</p>
                        <div class="follow">
                            <p>フォロー数</p>
                            <p>{{ $follower_count }}名</p>
                        </div>
                <div class="side-bar-btn">
                    <p class="btn1"><a href="/follow">フォローリスト</a></p>
                </div>
                <div class="follower">
                <p>フォロワー数</p>
                <p>{{ $follow_count }}名</p>
                </div>
                <div class="side-bar-btn">
                    <p class="btn2"><a href="/follower">フォロワーリスト</a></p>
                </div>
            </div>
                <div class="side-bar-btn">
                    <p class="btn3"><a href="/search">ユーザー検索</a></p>
                </div>
        </div>
    </div>
    <footer>
    </footer>
</body>
</html>
