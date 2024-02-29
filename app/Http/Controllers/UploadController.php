<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    //
        public function index(){

    return view('index');
    }


public function store(Request $request)
{
    $file_name = $request->file('file')->getClientOriginalName();
    $request->file('file')->storeAs('',$file_name);
    dd($request->file('file'));
}




}
