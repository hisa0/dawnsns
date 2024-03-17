@extends('layouts.login')

@section('content')
<div class="container-profile">
          @if(Request::routeIS('profile'))
        <div class="profile-box">
          {!! Form::open(['url'=>'/profile/update','files' => true]) !!}
              <div class="profile_icon">
                <img src="{{ asset('/images/dawn.png')}}"alt = "dawn.png" class="user_icon">
              </div>
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
                            <li class="profile-pass">{!! Form::input('password', 'password', null,['class' => 'profile-form']) !!}</li>
                          </ul>

                          <ul class="profile-date">
                            <li class="profile">{!! Form::label('profile','new Password') !!}</li>
                            <li class="profile-new-pass">{!! Form::input('password', 'newPass', null, ['class' => 'profile-form']) !!}</li>
                          </ul>

                          <ul class="profile-date">
                            <li class="profile">{!! Form::label('profile','Bio') !!}</li>
                            <li class="profile-bio">{!! Form::input('text', 'newBio', $user->bio, ['class' => 'profile-form']) !!}</li>
                          </ul>

                          <ul class="profile-date">
                            <li class="profile">{!! Form::label('profile','Icon Image') !!}</li>
                              <li class="profile-image">
                                <label for="file" value="Icon Image">ファイルを選択
                                  @csrf
                                  <input type="file" name= "file" id="file"  class="form-control" style="display:none;">
                              </label></li>
                          </ul>
                      {{ csrf_field()}}
                        <button type="submit" class="profile-form-btn">更新</button>
                </div>
            {!! Form::close() !!}
        </div>
            @endif
</div>
<!--:::::::::::::::::::::::認証ユーザー以外のprofile:::::::::::::::::::::::-->
<div class="container-profile-o">
  @if(Request::routeIS('other_profile'))
      <div class="container-o">
        <!-- :::::::::: 共有 :::::::::: -->
        {!! Form::open(['url' => route('other_profile',['id']),'method' => 'get']) !!}
            @foreach($users as $user)
                <div class="profiles-o">
                    @if($id == $user->follow )<!--$idユーザーとfollowユーザーが==なら以下実行 -->
                      <div class="profile-o-u">
                        <a href="#"><img src="/storage/images/{{ $user->images }}" class= "user_icon"></a>
                          <ul>
                            <li class="profile-o">{!! Form::label('profile','Name') !!}</li>
                            <li class="profile-name-o">{{ $user->username }}</li>
                          </ul>
                      </div>
                            <div class="profile-o-b">
                              <ul>
                                <li class="profile-bio-o">{!! Form::label('bio','Bio') !!}</li>
                                <li class="profile-bio-o-text">{{ $user->bio }}</li>
                              </ul>
                </div>
                    @endif
                </div>
                @break
            @endforeach
        {!! Form::close() !!}

        <!-- :::::::::: フォロー済 :::::::::: -->
        @foreach($users as $user)
          <div class="profile_btn">
              @if(Auth::user()->id == $user->follower)
                          {!! Form::open(['url' => 'user/un-follow']) !!}
                          {!! Form::hidden('id',$user->id) !!}
                          <button type="submit" class="search-unFollow_btn">フォローをはずす</button>
                          {!! Form::close() !!}
          </div>
        <!-- :::::::::: 未フォロー :::::::::: -->
          <div class="profile_btn">
              @elseif(Auth::user()->id != $user->follower)
                          {!! Form::open(['url' => 'user/follow']) !!}
                          {!! Form::hidden('id',$user->id) !!}
                          <button type="submit" class="search-follow_btn">フォローする</button>
                          {!! Form::close() !!}
              @endif
          </div>
            @break
        @endforeach
      </div>

        <!-- ::::: 認証ユーザー以外の投稿 ::::: -->
      <div class="container-o-post">
      @foreach($posts as $post)
            @if($id == $post->user_id)
            <div class="tweet_all">
                  <div class="tweet_data-o">
                    <div class="tweet_i_n_t">
                      <a href="#"><img src="/storage/images/{{ $post->images }}" class= "user_icon"></a>
                      <p class="tweet_name">{{ $post->username}}</p>
                      <p class="tweet_time">{{ $post->created_at }}</p>
                    </div>
                      <div class="tweet_text">{{ $post->posts }}</div>
                  </div>
            </div>
            @endif
        @endforeach
      </div>
  @endif
</div>
@endsection
