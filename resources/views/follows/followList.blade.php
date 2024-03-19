@extends('layouts.login')

@section('content')
<!--フォローユーザー表示（アイコン）-->
<div class="container-follow">
      <div class="follow-list">
      {!! Form::open(['url' => '/follow']) !!}
      {!! Form::label('follow-list','Follow list') !!}
            @if($followUser->isNotEmpty())
            <div class="follow-users">
            @foreach ($followUser as $user)
                                          <a href="/{{$user->id}}/profile"><img src="/storage/images/{{$user->images }}" class= "user_icon"></a>
            @endforeach
            </div>
            @endif
      {!! Form::close() !!}
      </div>
      <!-- フォローユーザーの投稿 -->
      @foreach ($posts as $post)
      @if(Auth::user()->id == $post->follower)
            <div class="tweet_all">
                  <div class="tweet_data">
                        <div class="tweet_i_n_t_t">
                              <div class="tweet_i_n_t">
                                          <a href="#"><img src="/storage/images/{{$post->images }}" class= "user_icon"></a>
                                          <p class="tweet_name">{{ $post->username}}</p>
                                          <p class="tweet_time">{{ $post->created_at }}</p>
                              </div>
                              <div class="tweet_text">{{ $post->posts }}</div>
                        </div>
                  </div>
            </div>
      @endif
      @endforeach
</div>
@endsection
