@extends('layouts.login')
@livewire('modal')

@section('content')
<body>
  <div class="tweets">
    <!-- 投稿機能-->
          <div class="container_tweet">
              <div class="tweet">
                  <h1><a><img src="/images/dawn.png" class="user_icon"></a></h1>
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
      @foreach ($posts as $post)
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
                    @if(Auth::user()->id == $post->user_id)
                    <div class="btns">
                        <button wire:click="openModal()" type="button" class="update_modal">
                        <a class="btn_up btn-success primary"  href="/{{ $post->id }}/modal"><img src="/images/edit.png" alt="編集"/></a>
                    </button>
                        <a class="btn_del btn-success primary" href="/post/{{ $post->id }}/delete" onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')" ><img src="images/trash.png" alt="削除"/></a>
                    </div>
                    @endif
            </div>
      @endforeach
    </div>
</div>
@endsection
