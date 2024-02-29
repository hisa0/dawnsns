@extends('layouts.logout')

@section('content')

<!-- ログイン画面　-->

{!! Form::open() !!}
    <div class="form-group">

            <p class="label">DAWNSNSへようこそ</p>
    {{ csrf_field() }}
        {{ Form::label('MailAdress') }}
        {{ Form::text('mail',null,['class' => 'input']) }}
            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif

        {{ Form::label('Password') }}
        {{ Form::password('password',['class' => 'input']) }}
            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
    <div class="submit">
        {{ Form::submit('LOGIN') }}
            <p class="link_btn_1"><a href="/register">新規ユーザーの方はこちら</a></p>
    </div>
</div>
{!! Form::close() !!}
@endsection
