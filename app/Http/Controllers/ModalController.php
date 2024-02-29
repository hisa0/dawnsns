<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ModalController extends Controller
{
    //

    public function modal()
    {
// xxxxxx

        $id = Auth::id();
        $posts = DB::table('posts')
        ->where('user_id','=',$id)
        ->select('posts.id','posts.posts','posts.created_at')->latest()
        ->get();

        return view('livewire.modal',['posts' => $posts]);
    }
}
