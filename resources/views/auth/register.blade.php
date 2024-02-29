@extends('layouts.logout')

@section('content')
{!! Form::open(['url' => '/register']) !!}
<!-- 新規ユーザー登録画面 -->
<div class="form-group">
<h2 class='titleArea'>新規ユーザー登録</h2>

{{ csrf_field() }}

{{ Form::label('UserName') }}
{{ Form::text('username',null,['class' => 'input'])}}
<p class="errors">{{ $errors->has('username') ? '入力必須です' : '' }}</p>
<br>

{{ Form::label('MailAdress') }}
{{ Form::text('mail',null,['class' => 'input'])}}
<p class="errors">{{ $errors->has('mail') ? '入力必須です' : ''}}</p>
<br>

{{ Form::label('Password') }}
{{ Form::text('password',null,['class' => 'input']) }}
<p class="errors">{{ $errors->has('password') ? '入力必須です' : ''}}</p>

<br>

{{ Form::label('password_confirm') }}
{{ Form::text('password_confirmation',null,['class' => 'input']) }}
<p class="errors">{{ $errors->has('password_confirm') ? '入力必須です' : ''}}</p>

@if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)

        @endforeach
      </ul>
    </div>
@endif

<div class="submit">
{{ Form::submit('REGISTER') }}
<p class="link_btn_2"><a href="/login">ログイン画面へ戻る</a></p>
</div>
</div>
{!! Form::close('') !!}


@endsection
