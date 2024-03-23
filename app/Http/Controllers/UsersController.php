<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
//[プロフィール・自分]:::::::::::::::::::::::::::::::::::::::::::::::::::
    public function profile()
    {
        $id = Auth::id();//認証ユーザーID

        $user = DB::table('users')->find($id);
        $user_name = Auth::user()->username;
        $email = Auth::user()->email;
        $password = Auth::user()->password;

        $follow_count = DB::table('follows')
            ->where('follow',$id)
            ->count();

        $follower_count = DB::table('follows')
            ->where('follower',$id)
            ->count();

        return view('users.profile',['user' =>$user,'follow_count' => $follow_count,'follower_count' => $follower_count]);
    }
//[プロフィール・相手]:::::::::::::::::::::::::::::::::::::::::::::::::::
    public function otherProfile($id)
    {
        $auth = Auth::id();//認証ユーザーID

        $id;//followユーザーid

        $users = DB::table('users')
            ->leftJoin('follows','users.id','=','follows.follow')
            ->where('users.id',$id)
            ->select(
                'users.id','users.username','users.bio','users.images',
                'follows.follower','follows.follow')
            ->get();

        $posts = DB::table('posts')
        ->where('user_id',$id)
        ->leftJoin('users','users.id','=','posts.user_id')
        ->select(
            'posts.id','posts.user_id','posts.posts','posts.created_at',
            'users.username','users.images'
            )->latest()->get();

        $follow_count = DB::table('follows')
            ->where('follow',$auth)
            ->count();
        $follower_count = DB::table('follows')
            ->where('follower',$auth)
            ->count();

        return view('users.profile',['id' => $id,'users' => $users,'follow_count' => $follow_count,'follower_count' => $follower_count,'posts'=>$posts]);
    }
//[ユーザー検索top]::::::::::::::::::::::::::::::::::::::::::::::::::::::
        public function index()
    {
        $user = Auth::id();
        $users = DB::table('users')
                ->leftJoin('follows','follows.follow','=','users.id')
                ->select('users.id','users.username','users.images','follows.follower')
                ->get();

        $follow_count = DB::table('follows')//followユーザー数
                ->where('follower',$user)
                ->count();
        $follower_count = DB::table('follows')//followerユーザー数
                ->where('follow',$user)
                ->count();

        return view('users.search',['users'=> $users,'follow_count' => $follow_count,'follower_count' => $follower_count]);
    }

//[検索機能]:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    public function search(Request $request)
    {
        $user = Auth::id();
        $query = DB::table('users')
        ->leftJoin('follows','follows.follow','=','users.id')
        ->select(
                'users.id','users.username','users.images',
                'follows.follow','follows.follower');

        $keyword = $request->input('keyword');
        if(!empty($keyword)) {
        $query = $query->where('username', 'LIKE', "%{$keyword}%");
        }
        $users = $query->get();
        dd($users);

        $follow_count = DB::table('follows')//followユーザー数
                ->where('follower',$user)
                ->count();
        $follower_count = DB::table('follows')//followerユーザー数
                ->where('follow',$user)
                ->count();

        return view('users.search', ['query'=>$query,'users' => $users,'keyword' =>$keyword,'follow_count' => $follow_count,'follower_count' => $follower_count]);
    }

//[profile更新機能]::::::::::::::::::::::::::::::::::::::::::::::::::::::
    public function update(Request $request)
    {
        $new_username = $request->input('newUsername');
        $new_mail = $request->input('newMail');
        $new_pass = $request->input('newPass');
        $new_bio = $request->input('newBio');
        $file = $request->file('file');

            DB::table('users')
            ->where('id', Auth::id())
            ->update([
                'username' => $new_username,
                'mail'=> $new_mail,
                'bio' => $new_bio,
            ]);
    if(!empty($file)){
        $file_name = $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('public/images',$file_name);
            DB::table('users')
            ->where('id', Auth::id())
            ->update(['images' => $file_name
                    ]);
        }

    if(!empty($new_pass)){
            DB::table('users')
            ->where('id', Auth::id())
            ->update([
            'password' => $new_pass,
            ]);
            }
            return redirect('/profile');
        }

}
