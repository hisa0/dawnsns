@extends('layouts.login')


@section('content')
<body>
  <!-- 投稿画面 -->
    <div class="tweets">
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
              <div class="btns">
                    <button type="submit" class="tweet_btn btn-primary pull-right"><img src="/images/post.png" alt="投稿"/>
              </div>
                    {!!  Form::close() !!}
          </div>
      </div>
    </div>


<!--投稿内容の表示-->
  <div class="tweet_all_date">
      @foreach ($posts as $post)
                      <!-- modal内容・終 -->
          <!-- followユーザーの投稿 -->
          <div class="tweet_all">
              <div class="tweet_data">
        @if(Auth::user()->id == $post->follower)
                      <div class="tweet_i_n_t">
                          <a href="#"><img src="/storage/images/{{ $post->images }}" class= "user_icon"></a>
                          <p class="tweet_name">{{ $post->username}}</p>
                          <p class="tweet_time">{{ $post->created_at }}</p>
                      </div>
                          <div class="tweet_text">{{ $post->posts }}</div>
          <!-- Authユーザーの投稿 -->
        @elseif(Auth::user()->id == $post->user_id)
                      <div class="tweet_i_n_t">
                          <a href="#"><img src="/storage/images/{{$post->images }}" class= "user_icon"></a>
                          <p class="tweet_name">{{ $post->username}}</p>
                          <p class="tweet_time">{{ $post->created_at }}</p>
                      </div>
                          <div class="tweet_text">{{ $post->posts }}</div>

    <!-- ::::::::::::::::::::::::::::::::: modal :::::::::::::::::::::::::::::::::-->
                                <div class="modal-main js-modal" id="updateModal">
                                    <div class="modal-inner"><!--白背景-->
                                        <div class="modal_window">
                                            <div class="inner-content"><!--モーダル中身-->
                                                    {!!Form::open(['url'=>'/post/update'])!!}
                                                    {!!Form::textarea('upPost', $post->posts,['required'])!!}
                                                    {!!Form::hidden('id', $post->id) !!}
                                                    <div class="btns">
                                                      <button type="submit" class="update" href="/post/{{ $post->id }}/update"><img src="/images/edit.png" alt="更新"/></button>
                                                    </div>
                                                    {!!Form::close()!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                      <div class="modal-update">
                            <!-- 編集/削除button -->
                            <div class="btns">
                                <button type="submit" class="modal-open" data-target="updateModal" href="/post/{{ $post->id }}/update"><img src="/images/edit.png" alt="編集"/></button>
                                <a class="btn_del btn-success primary" href="/post/{{ $post->id }}/delete" onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')" ><img src="images/trash.png" alt="削除"/></a>
                            </div>
                      </div>
<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
        @endif
              </div>
          </div>
      @endforeach
  </div>
</body>
@endsection
