<?php
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ModalController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//【ログアウト中のページ】::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

//【新規登録】:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

//【新規登録完了】:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
Route::get('/added', 'Auth\RegisterController@added');

//【ログイン中のページ】::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
Route::get('/index','PostsController@index');
Route::get('/top','PostsController@index');
Route::get('/logout','PostsController@logout');

  //【プロフィール編集画面】::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
Route::get('/profile','UsersController@profile')->name('profile');

  //【他ユーザープロフィール画面】::::::::::::::::::::::::::::::::::::::::::::::::::::::::
Route::get('{id}/profile','UsersController@otherProfile')->name('other_profile');

//【プロフィール編集】:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
Route::post('/profile/update', 'UsersController@update')->name('profile_update');

//【プロフィール編集/password】::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
Route::put('/password_change', 'UserController@passwordUpdate')->name('password_edit');

//【検索:ユーザー名】::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
Route::get('/search','UsersController@index');
Route::post('/search/result','UsersController@search')->name('search/result');

//【follow/followerリスト】:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
Route::get('/follow', 'FollowsController@followList');
Route::get('/follower', 'FollowsController@followerList');

//【投稿:編集・投稿・削除】::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
Route::post('post/update','PostsController@update');//ツイート編集
Route::prefix('post')
    ->middleware('auth')
    ->group(function (){
      Route::post('create','PostsController@create');//ツイート投稿
      Route::get('{id}/delete','PostsController@delete')->name('delete');//ツイート削除
    });

//【フォロ機能/フォロー解除機能】:::::::::::::::::::::::::::::::::::::::::::::::::::::::::
Route::post('user/follow','FollowsController@follow')->name('user.follow');
Route::post('user/un-follow','FollowsController@unFollow')->name('un.follow');

//file upLoad
Route::resource('upload',UploadController::class);
