<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

//::::::バリデーションルール:::::://
    public function validator(Request $request)
    {
        $validateData = $request->validate([
            'username' => 'required|string|max:255',
            'mail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
            'password_confirmation' => 'required',
        ]);
    }
//::::::投稿内容表示:::::://
    public function index()
    {
        $id = Auth::id();//認証ユーザーID

        $posts = DB::table('posts')
        ->leftJoin('follows','follows.follow','=','posts.user_id')
        ->leftJoin('users','posts.user_id','=','users.id')
        ->select('posts.id','posts.user_id','posts.posts','posts.created_at','users.images')->latest()
        ->get();

        $user_name = DB::table('users')
            ->get();

        $follow_count = DB::table('follows')
            ->where('follow',$id)
            ->count();

        $follower_count = DB::table('follows')
            ->where('follower',$id)
            ->count();
        return view('posts.index',['posts' => $posts,'user_name'=>$user_name,'follow_count' => $follow_count,'follower_count' => $follower_count]);
    }

    public function register()
    {
        return view('/index',['posts'=>$posts]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login');
    }
//::::::投稿機能:::::://
    public function create(Request $request)
    {
        $username = DB::table('users');
        $user = Auth::id();
        $post = $request->input('newPost');
        DB::table('posts')->insert([
            'user_id'=> $user,
            'posts'=> $post,
            'created_at' => now(),
        ]);
        return redirect('/top');
    }
//::::::編集処理:::::://
    public function update(Request $request)
    {
        $id = $request->input('id');
        $up_post = $request->input('upPost');
        DB::table('posts')
            ->where('id', $id)
            ->update(
                ['posts' => $up_post]
            );

        return redirect('/top');
    }
//::::::投稿削除:::::://
    public function delete($id)
    {
        DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('/top');
    }

public function followCount()
{

        return view('posts.index');
}
}
