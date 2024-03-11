<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class FollowsController extends Controller
{
    public function index()
    {
        return view('follows.followList');
    }

        public function register()
    {
        return view('follows.followList',['follows'=>$follows]);
    }
    //:::[follow]:::
    public function follow(Request $request)
{
    $user = Auth::id();//認証ユーザーid取得
    $id = $request->input('id');//対象ユーザーid取得
    DB::table('follows')->insert([
        'follow'=>$id,
        'follower'=> $user,
    ]);
return redirect('/search');
}
//:::[un_follow]:::

public function unFollow(Request $request)
{
    $user = Auth::id();
    $id = $request->input('id');
    DB::table('follows')->where([

        'follower' =>$user,
        'follow' => $id
    ])->delete();
        return redirect('/search');
}

    public function followList()
    {
        $user = Auth::id();
        $users = DB::table('users')->get();

        $follows = DB::table('follows')
                ->where('follower','=',$user)//認証ユーザーとfollowerが同じ
                ->get();

        $followers = DB::table('follows')
                ->join('users','users.id','=','follows.follow')
                ->select('users.id','users.images')
                ->get();

        $follow_count = DB::table('follows')//followユーザー数
                ->where('follow',$user)
                ->count();
        $follower_count = DB::table('follows')//followerユーザー数
                ->where('follower',$user)
                ->count();

        $posts = DB::table('posts')//フォローユーザーのデータ
        ->leftJoin('follows','follows.follow','=','posts.user_id')
        ->leftJoin('users','posts.user_id','=','users.id')
        ->select(
            'posts.id','posts.user_id','posts.posts','posts.created_at',
            'users.id','users.username','users.images',
            'follows.follow','follows.follower')
            ->latest()
        ->get();

        $user_name = DB::table('users')
            ->get();

        return view('follows.followList',['users' => $users,'follows'=>$follows,'followers' => $followers,'follow_count' => $follow_count,'follower_count' => $follower_count,'posts'=>$posts,'user_name'=>$user_name]);
    }

    public function followerList()
        {
        $user = Auth::id();
        $users = DB::table('users');
        $followers = DB::table('follows')
                ->where('follow','=',$user)//認証ユーザーとfollowが同じ
                ->get();

        $follows = DB::table('follows')
                ->join('users','users.id','=','follows.follower')
                ->select('users.id','users.images')
                ->get();
        $posts = DB::table('posts')//フォローユーザーのデータ
        ->leftJoin('follows','follows.follower','=','posts.user_id')
        ->leftJoin('users','posts.user_id','=','users.id')
        ->select(
            'posts.id','posts.user_id','posts.posts','posts.created_at',
            'users.id','users.username','users.images',
            'follows.follow','follows.follower')
            ->latest()
        ->get();


        $follow_count = DB::table('follows')//followユーザー数
                ->where('follow',$user)
                ->count();
        $follower_count = DB::table('follows')//followerユーザー数
                ->where('follower',$user)
                ->count();
        return view('follows.followerList',['users' => $users,'followers' => $followers,'follows' => $follows,'follow_count' => $follow_count,'follower_count' => $follower_count,'posts'=>$posts]);
    }
}
