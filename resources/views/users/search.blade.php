@extends('layouts.login')

@section('content')
<!--ユーザー検索-->
<body>
    <table>
      <div class=container-search>
      {!! Form::open(['route' =>['search/result'],'method' => 'post']) !!}
          <div class="search-name">
                {!! Form::input('text', 'keyword', null, ['required', 'class' => 'search-name', 'placeholder' => 'ユーザー名']) !!}
                  <button type="submit" class="search-btn">検索</button>
                  <div class="keyword">
                  <label >検索ワード：</label>
                      @if(!empty($keyword))
                      {{ $keyword }}
                      @endif
                  </div>
          </div>
        {!! Form::close() !!}
      </div>
        <!--ユーザー一覧-->
            @foreach($users as $user)
                <div class="search-users">
                  <!--フォロー済ユーザー表示-->
                    @if(Auth::user()->id == $user->follower)
                        <ul>
                          <li class="search-result-image"><img src="{{ asset('images/dawn.png')}}"alt = "dawn.png" class="user_icon"><li>
                          <li class="search-result-name">{{ $user->username }}</li>
                          {!! Form::open(['url' => 'user/un-follow']) !!}
                          {!! Form::hidden('id',$user->id) !!}
                          <div class="un_follow_btn">
                          <li><button type="submit" class="search-unFollow_btn">フォローをはずす</button></li>
                          </div>
                          {!! Form::close() !!}
                        </ul>
                        <!--未フォローユーザー表示-->
                    @elseif(Auth::user()->id != $user->id)
                      @if (Auth::user()->id != $user->follower)
                        <ul>
                          <li class="search-result-image"><img src="{{ asset('images/dawn.png')}}"alt = "dawn.png" class="user_icon"><li>
                          <li class="search-result-name">{{ $user->username }}</li>
                          {!! Form::open(['url' => 'user/follow']) !!}
                          {!! Form::hidden('id',$user->id) !!}
                          <div class="follow_btn">
                          <li><button type="submit" class="search-follow_btn">フォローする</button></li>
                          </div>
                          {!! Form::close() !!}
                      </ul>
                      @endif
                    @endif
                </div>
              @endforeach
    </table>
</body>

@endsection
