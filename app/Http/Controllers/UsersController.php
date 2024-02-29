<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
    //:::プロフィール画面::://
    public function profile(){
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

    public function otherProfile()
    {
        $id = Auth::id();//認証ユーザーID

        $users = DB::table('users')
                ->leftJoin('follows','follows.follow','=','users.id')
                ->select('users.id','users.username','follows.follower')
                ->get();

        $follow_count = DB::table('follows')
            ->where('follow',$id)
            ->count();
        $follower_count = DB::table('follows')
            ->where('follower',$id)
            ->count();

        return view('users.profile',['users' => $users,'follow_count' => $follow_count,'follower_count' => $follower_count]);
    }

    //:::ユーザー検索top::://
        public function index()
    {
        $user = Auth::id();
        $users = DB::table('users')
                ->leftJoin('follows','follows.follow','=','users.id')
                ->select('users.id','users.username','follows.follower')
                ->get();
        $follows = DB::table('follows')
        ->get();

        $follow_count = DB::table('follows')//followユーザー数
                ->where('follower',$user)
                ->count();
        $follower_count = DB::table('follows')//followerユーザー数
                ->where('follow',$user)
                ->count();

        return view('users.search',['users'=> $users,'follows' => $follows,'follow_count' => $follow_count,'follower_count' => $follower_count]);
    }

    //:::検索機能::://
    public function search(Request $request)
    {
        $query = DB::table('users')
                ->leftJoin('follows','follows.follow','=','users.id')
                ->select('users.id','users.username','follows.follower')
                ->get();
        $keyword = $request->input('keyword');
        if(!empty($keyword)) {
        $query = $query->where('username', 'LIKE', "%{$keyword}%");
        }

        $users_src = $query->get();
        return view('users.search', ['users_src' => $users_src,'keyword' =>$keyword]);
    }


    public function follow(User $user)
    {
            $follower = auth()->user();//フォローチェック
            $is_following = $follower->isFollowing($user->id);
            if(!$is_following) //フォローしていなければフォローする
            {
                $follower->follow($user->id);
                return back();
            }
    }

    public function unfollow(User $user)//フォロー解除
    {
        $follower = auth()->user();//フォローチェック
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following) //フォローしていればフォローを解除する
        {
            $follower->unfollow($user->id);
            return back();
        }
    }

    public function countFollowings()
    {
        $userId = Auth::user()->id;
        $count_followings = \DB::connection('')
            ->table('follows')
            ->where('user_id', '=', $userId)
            ->count();

        return view('layouts.login', [
            'count_followings' => $count_followings]);
    }

    public function image(Request $request, User $user)
    {
        $images = $request->image;

        $filePath = $images->store('public');
        $user->image = str_replace('public','',$images);
        $user->save();
        return redirect("/user/{$user->id}")->with('user',$user);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');

        $new_username = $request->input('newUsername');
        $new_mail = $request->input('newMail');
        $new_pass = $request->input('newPass');
        $new_bio = $request->input('newBio');
        $file = $request->file('file')->getClientOriginalName();
            DB::table('users')
            ->where('id', Auth::id())
            ->update([
                'username' => $new_username,
                'images' => $file
            ]);

            $request->file('file')->storeAs('public/images',$file);
        //更新処理記載する
    }

}
