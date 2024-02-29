@extends('layouts.login')

@section('content')

@if(Request::routeIS('profile'))
{!! Form::open(['url'=>'/profile/update','files' => true]) !!}
  <div class="container-profile">
    <div class="profile_icon"><img src="{{ asset('images/dawn.png')}}"alt = "dawn.png" class="user_icon"></div>
      <div class="profiles">
                <ul class="profile-date">
                  <li class="profile">{!! Form::label('profile','UserName') !!}</li>
                  <li class="profile-name">{!! Form::input('text', 'newUsername', $user->username, ['required', 'class' => 'profile-form']) !!}</li>
                </ul>
                <ul class="profile-date">
                  <li class="profile">{!! Form::label('profile','MailAdress') !!}</li>
                  <li class="profile-mail">{!! Form::input('text', 'newMail', $user->mail, ['required', 'class' => 'profile-form']) !!}</li>
                </ul>

                <ul class="profile-date">
                  <li class="profile">{!! Form::label('profile','Password') !!}</li>
                  <li class="profile-pass">{!! Form::input('text', 'password', '●●●●●●●', ['required', 'class' => 'profile-form']) !!}</li>
                </ul>

                <ul class="profile-date">
                  <li class="profile">{!! Form::label('profile','new Password') !!}</li>
                  <li class="profile-new-pass">{!! Form::input('text', 'newPass', null, ['class' => 'profile-form']) !!}</li>
                </ul>

                <ul class="profile-date">
                  <li class="profile">{!! Form::label('profile','Bio') !!}</li>
                  <li class="profile-bio">{!! Form::input('text', 'newBio', $user->bio, ['class' => 'profile-form']) !!}</li>
                </ul>

                <ul class="profile-date">
                  <li class="profile">{!! Form::label('profile','Icon Image') !!}</li>
                    <li class="profile-image">
                      <label for="file" valu="Icon Image">ファイルを選択
                        @csrf
                        <input type="file" name= "file" id="file"  class="form-control" style="display:none;">
                    </label></li>
                </ul>
            {{ csrf_field()}}
      <button type="submit" class="profile-form-btn">更新</button>
              </div>
  </div>
  {!! Form::close() !!}
@endif

<!--認証ユーザー以外のprofile-->
@if(Request::routeIS('other_profile'))
{!! Form::open(['url' => route('other_profile',['id']),'method' => 'get']) !!}
    @foreach($users as $user)
      @if(Auth::user()->id == $user->follower)
      <div class="profiles-other">
        <!--ユーザーアイコンxxxxxxxxx-->
          <ul class="profile-date-o">
            <li class="profile">{!! Form::label('profile','Name') !!}</li>
            <li class="profile-name-o">{{ $user->username }}</li>
          </ul>
      </div>
      @endif
    @endforeach
{!! Form::close() !!}
@endif
@endsection
