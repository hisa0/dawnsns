@extends('layouts.login')

@section('content')
<!--フォローユーザー表示（アイコン）-->
<div class="container-follow">
      <div class="follow-list">
                  {!! Form::open(['url' => '/follow']) !!}
                  {!! Form::label('follow-list','Follow list') !!}
                  {!! Form::close() !!}
            @if($follows->isNotEmpty())
                  @foreach($follows as $follow)
                  @endforeach
            @if(Auth::user()->id == $follow->follower)
                  @foreach($followers as $follower)
                  <div class="follow-users">
                        <a href="/{{$follower->id}}/profile"><img src="/storage/images/{{$follower->images }}" class= "user_icon"></a>
                  </div>
                  @endforeach
            @endif
            @endif
      </div>
      <!-- フォローユーザーの投稿 -->
      @foreach ($posts as $post)
      @if(Auth::user()->id != $post->user_id)
            <div class="tweet_all">
                  <div class="tweet_data">
                        <div class="tweet_i_n_t">
                              <a href="#"><img src="/storage/images/{{$post->images }}" class= "user_icon"></a>
                                    @foreach($user_name as $name)
                                          @if($post->user_id == $name->id)
                                                <p class="tweet_name">{{ $name->username}}</p>
                                                <p class="tweet_time">{{ $post->created_at }}</p>
                                          @endif
                                    @endforeach
                        </div>
                  <div class="tweet_text">{{ $post->posts }}</div>
                  </div>
            </div>
      @endif
      @endforeach
</div>
@endsection
