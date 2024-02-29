<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

     //バリデート
    public function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'mail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    //DBに登録
    public function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
        $data = $request->input();
            $request->validate(
    [
            'username' => 'required|string|max:255',
            'mail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
    ],
            //検証ルールに反する場合のエラー
    [
        //username
            'username.required' => '入力必須です',
            'username.min' =>'お名前は4文字以上で入力してください',
            'username.max' =>'お名前は12文字以内で入力してください',
        //e-mail
            'mail.required' => '入力必須です',
            'mail.email' => '正しいmailアドレスを入力してください',
            'mail.min' => 'mailアドレスは4文字以上で入力してください',
            'mail.max' => 'mailアドレスは12文字以内で入力してください',
            'mail.unique' => 'そのメールアドレスは既に登録されています',
        //password
            'password.required' => '入力必須です',
            'password.min' => 'パスワードは4文字以上で入力してください',
            'password.max' => 'パスワードは12文字以内で入力してください',
            'password.unique' => 'そのパスワードは既に登録されています',
        //password confirm
            'password.confirmed' => '入力されたパスワードと一致しません',
            'password_confirmation.required' => '確認用パスワードは入力必須です。',
    ]);
            $this->create($data);
            session()->put('username',$data['username']);
            return redirect('added');
        }
        return view('auth.register');
    }

    public function added(Request $request){
        $username = $request->input('username');
                return view('auth.added',['username' => $username]);
    }
}
