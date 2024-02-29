@extends('layouts.login')

@section('content')


<!--フォローユーザー表示（アイコン）-->
<div class="container-follow">
      <div class="follow-list">
            {!! Form::open(['url' => '/follow']) !!}
            {!! Form::label('follow-list','Follow list') !!}
            {!! Form::close() !!}
      </div>
@if($follows->isNotEmpty())
      @foreach($follows as $follow)
      @endforeach
      @if(Auth::user()->id == $follow->follower)
            @foreach($followers as $follower)
            <div class="follow-users">
            <a href="/{{$follower->id}}/profile">{{ $follower->id }}</a>
                  <!-- <img src="{{ $follower->images }}"alt = "dawn.png"> -->
                  </div>
      @endforeach
      @endif
@endif
</div>


@endsection
