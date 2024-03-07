@extends('layouts.login')


@section('content')

<body>
  <div class="tweets">
    <!-- 投稿機能-->
          <div class="container_tweet">
              <div class="tweet">

            @foreach ($posts as $post)
                @if(Auth::user()->id == $post->user_id)
                  <h1><a><img src="/storage/images/{{$post->images }}" class= "user_icon"></a></h1>
                @endif
                @break
                @endforeach

                    {!! Form::open(['url' => 'post/create']) !!}
                    {!! Form::textarea('newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '何をつぶやこうか...?','maxlength'=>'150']) !!}
              </div>
                <div class="btns">
                <button type="submit" class="tweet_btn btn-primary pull-right"><img src="/images/post.png" alt="投稿"/></button>
              </div>
                  {!!  Form::close() !!}
          </div>

    <!--投稿内容の表示-->
<div class="tweet_all_date">
  <!-- followユーザーの投稿 -->
@foreach ($posts as $post)
  @if(Auth::user()->id == $post->follower)
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
  <!-- Authユーザーの投稿-->
  @if(Auth::user()->id == $post->user_id)
      <div class="tweet_all">
        <div class="tweet_data">
              <div class="tweet_i_n_t">
                <a href="#"><img src="/storage/images/{{$post->images }}" class= "user_icon"></a>
                      <p class="tweet_name">{{ $post->username}}</p>
                      <p class="tweet_time">{{ $post->created_at }}</p>
              </div>
              <div class="tweet_text">{{ $post->posts }}</div>
        </div>
          <div class="btns">
              <!-- modalトリガー -->
                    <div class="modal-update">
                      <a href="" class="modal-open" data-target="updateModal"><img src="/images/edit.png" alt="編集"/></a>
                    </div>
              <!-- modal内容・始-->
              <div class="modal-main js-modal" id="updateModal">
                  <div class="modal-inner"><!--白背景-->
                    <div class="modal_window">
                      <div class="inner-content"><!--モーダル中身-->
                        {!!Form::open(['url'=>['/post/update'],'method'=>'POST'])!!}
                        {!!Form::hidden('id',$post->id) !!}
                            @if('id = $post->id')
                              {!!Form::textarea('upPost', $post->posts,['required','maxlength'=>'150'])!!}
                            @endif
                            <button type="submit" class="update"><img src="/images/edit.png" alt="更新"/></button>
                        {!!Form::close()!!}
                      </div>
                    </div>
                  </div>
              </div>
              <!-- modal内容・終 -->

              <a class="btn_del btn-success primary" href="/post/{{ $post->id }}/delete" onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')" ><img src="images/trash.png" alt="削除"/></a>
          </div>
      </div>
    @endif
  @endforeach
  </div>
</div>


</body>

@endsection
