@extends('layouts.login')

@section('content')
<body>
    @csrf
  <!-- 投稿画面 -->
    <div class="tweets">
      <div class="container_tweet">
          <div class="tweet">
              @foreach ($posts as $post)
                    @if(Auth::user()->id == $post->user_id)
                      <h1><a><img src="{{ asset('images/'.$post->images) }}" class= "user_icon"></a></h1>
                      @endif
                  @break
              @endforeach
              {!! Form::open(['url' => 'post/create']) !!}
              {!! Form::textarea('newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '何をつぶやこうか...?','maxlength'=>'150']) !!}
          </div>
              <div class="tweet_btn">
                    <button type="submit" class="tweet_btn btn-primary pull-right"><img src="/images/post.png" alt="投稿"/>
              </div>
              {!!  Form::close() !!}
      </div>
    </div>

<!--投稿内容の表示-->
                  <!--:::::::::: followユーザーの投稿 ::::::::::-->

<!-- <div class="tweet_all"-->
<div class="tweet_all_date">
@foreach ($posts as $post)
        @if(Auth::user()->id == $post->follower)
        <div class="tweet_data">
          <div class="tweet_i_n_t_t">
                <div class="tweet_i_n_t">
                    <a href="#"><img src="{{ asset('images/'.$post->images) }}" class= "user_icon"></a>
                    <p class="tweet_name">{{ $post->username}}</p>
                    <p class="tweet_time">{{ $post->created_at }}</p>
                </div>
            <div class="tweet_text">{{ $post->posts }}</div>
          </div>
        </div>
            <!--:::::::::: Authユーザーの投稿 ::::::::::-->
        @elseif(Auth::user()->id == $post->user_id)
        <div class="tweet_data">
          <div class="tweet_i_n_t_t">
                <div class="tweet_i_n_t">
                    <a href="#"><img src="{{ asset('images/'.$post->images) }}" class= "user_icon"></a>
                    <p class="tweet_name">{{ $post->username}}</p>
                    <p class="tweet_time">{{ $post->created_at }}</p>
                </div>
                <div class="tweet_text">{{ $post->posts }}</div>
                <div class="btns">
                    <input type="image" class="modal-open" data-target="updateModal{{$post->id}}" src="/images/edit.png" alt="編集"/>
                    <a class="btn_del btn-success primary" href="/post/{{ $post->id }}/delete" onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')" ><img src="images/trash.png" alt="削除"/></a>
                </div>
          </div>
            <!-- ::::::::::モーダル部分:::::::::: -->
            <div class="modal-container modal-main js-modal" id="updateModal{{$post->id}}">
                <div class="modal-inner"><!--白背景-->
                    <div class="modal_window">
                        <div class="inner-content"><!--モーダル中身-->
                          {!!Form::open(['url'=>['/post/update'],'method'=>'POST'])!!}
                          {!!Form::hidden('id','$post->id') !!}
                          {!!Form::textarea('upPost', $post->posts,['required','maxlength'=>'150'])!!}
                              <div class="modal-close">
                                  <input type="image" src="/images/edit.png" class="update"/>
                              </div>
                          {!!Form::close()!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
@endforeach
</div>

</body>
@endsection
