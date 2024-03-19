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
//[follow]::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    public function follow(Request $request)
    {
    $user = Auth::id();
    $id = $request->input('id');
    DB::table('follows')->insert([
        'follow'=>$id,
        'follower'=> $user,
    ]);
    return back();
    }
//[un_follow]:::::::::::::::::::::::::::::::::::::::::::::::::::::::
    public function unFollow(Request $request)
    {
    $user = Auth::id();
    $id = $request->input('id');
    DB::table('follows')->where([

        'follower' =>$user,
        'follow' => $id
    ])->delete();
        return back();
    }
//[followList]::::::::::::::::::::::::::::::::::::::::::::::::::::::
    public function followList()
    {
        $user = Auth::id();
        $users = DB::table('users')->get();

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

        $followUser = DB::table('follows')
        ->where('follower',$user)
        ->leftJoin('users','users.id','=','follows.follow')
        ->select('users.id','users.username','users.images')
        ->get();

        return view('follows.followList',['follow_count' => $follow_count,'follower_count' => $follower_count,'posts'=>$posts,'followUser'=>$followUser]);
    }
//[followerList]::::::::::::::::::::::::::::::::::::::::::::::::::::
    public function followerList()
    {
        $user = Auth::id();

        $posts = DB::table('posts')//フォローユーザーのデータ
        ->leftJoin('follows','follows.follower','=','posts.user_id')
        ->leftJoin('users','posts.user_id','=','users.id')
        ->select(
            'posts.id','posts.user_id','posts.posts','posts.created_at',
            'users.id','users.username','users.images',
            'follows.follow','follows.follower')
            ->latest()
        ->get();

        $followerUser = DB::table('follows')
        ->where('follow',$user)
        ->leftJoin('users','users.id','=','follows.follower')
        ->select('users.id','users.username','users.images')
        ->get();

        $follow_count = DB::table('follows')//followユーザー数
                ->where('follow',$user)
                ->count();
        $follower_count = DB::table('follows')//followerユーザー数
                ->where('follower',$user)
                ->count();
        return view('follows.followerList',['follow_count' => $follow_count,'follower_count' => $follower_count,'posts'=>$posts,'followerUser'=>$followerUser]);
    }
}
