@extends('layouts.logout')

@section('content')
<!--新規登録後画面-->
<div class="container">
    <div class="username">
        <p>{{ session('username') }}さん</p>
    </div>
    <div class="welcome_letter">
        <p class="welcome">ようこそ！DAWNSNSへ！</p>
        <p class="welcome_2">ユーザー登録が完了しました。</p>
        <br>
        <p class="welcome_2">さっそく、ログインをしてみましょう</p>
    </div>

    <p class="link_btn_3"><a href="/login">{{ Form::submit('ログイン画面へ') }}</a></p>

</div>

@endsection
