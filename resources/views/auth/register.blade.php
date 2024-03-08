@extends('layouts.logout')

@section('content')
{!! Form::open(['url' => '/register']) !!}
<!-- 新規ユーザー登録画面 -->
<div class="form-group">
<h2 class='titleArea'>新規ユーザー登録</h2>

{{ csrf_field() }}

{{ Form::label('UserName') }}
{{ Form::text('username',null,['class' => 'input'])}}
@if ($errors->has('username'))
<p class="errors">
  <tr>
    @foreach($errors->get('username') as $message)
    {{ $message }}
    @endforeach
  </tr>
</p>
@endif

{{ Form::label('MailAdress') }}
{{ Form::text('mail',null,['class' => 'input'])}}
@if ($errors->has('mail'))
<p class="errors">
  <tr>
    @foreach($errors->get('mail') as $message)
    {{ $message }}
    @endforeach
  </tr>
</p>
@endif

{{ Form::label('Password') }}
{{ Form::text('password',null,['class' => 'input']) }}
@if ($errors->has('password'))
<p class="errors">
  <tr>
    @foreach($errors->get('password') as $message)
    {{ $message }}
    @endforeach
  </tr>
</p>
@endif

{{ Form::label('password_confirm') }}
{{ Form::text('password_confirmation',null,['class' => 'input']) }}
@if ($errors->has('password'))
<p class="errors">
  <tr>
    @foreach($errors->get('password') as $message)
    {{ $message }}
    @endforeach
  </tr>
</p>
@endif

<!-- @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
@endif -->

<div class="submit">
{{ Form::submit('REGISTER') }}
<p class="link_btn_2"><a href="/login">ログイン画面へ戻る</a></p>
</div>
</div>
{!! Form::close('') !!}


@endsection
