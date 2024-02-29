@extends('layouts.login')

@section('content')


<!--フォローユーザー表示（アイコン）-->
<div class="container-follower">
      <div class="follower-list">
      {!! Form::open(['url' => '/follower']) !!}
      {!! Form::label('follower-list','Follower list') !!}
      {!! Form::close() !!}
      </div>

      <!--$followersにデータが存在するときのみ実行-->
@if($followers->isNotEmpty())
      @foreach($followers as $follower)
      @endforeach
      @if(Auth::user()->id == $follower->follow)
      @foreach($follows as $follow)
      <div class="follow-users">
            <a href="/{{$follow->id}}/profile">{{ $follow->id }}</a>
            <!-- <img src="{{ $follow->images }}"alt = "dawn.png"></a> -->
                  </div>
      @endforeach
      @endif
@endif
</div>
@endsection
