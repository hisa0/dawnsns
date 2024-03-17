@extends('layouts.login')

@section('content')


<!--フォローユーザー表示（アイコン）-->
<div class="container-follower">
      <div class="follower-list">
      {!! Form::open(['url' => '/follower']) !!}
      {!! Form::label('follower-list','Follower list') !!}
            @if($followerUser->isNotEmpty())
            @foreach ($followerUser as $user)
                                    <div class="follow-users">
                                          <a href="/{{$user->id}}/profile"><img src="/storage/images/{{$user->images }}" class= "user_icon"></a>
                                    </div>
            @endforeach
            @endif
      {!! Form::close() !!}
      </div>

      <!--$followersにデータが存在するときのみ実行-->
      @foreach ($posts as $post)
      @if(Auth::user()->id == $post->follow)
            <div class="tweet_all">
                  <div class="tweet_data">
                        <div class="tweet_i_n_t">
                              <a href="#"><img src="/storage/images/{{$post->images }}" class= "user_icon"></a>
                                                <p class="tweet_name">{{ $post->username}}</p>
                                                <p class="tweet_time">{{ $post->created_at }}</p>
                        </div>
                  <div class="tweet_text">{{ $post->posts }}</div>
                  </div>
            </div>
      @endif
      @endforeach
</div>
@endsection
