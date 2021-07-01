<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

Route::get('', function () {
    return view('ruddit.index');
});

Route::resource('/posts', 'App\Http\Controllers\PostsController');
//Route::resource('/myposts', 'App\Http\Controllers\PostsController');
Route::resource('/comments', 'App\Http\Controllers\CommentsController');
Route::get('/myposts','App\Http\Controllers\PostsController@myposts')->name('posts.myposts');

Route::post('/posts/{skelbimoNr}','App\Http\Controllers\PostsController@likePost')->name('posts.like');
//Route::post('/filter','App\Http\Controllers\PostsController@filter')->name('posts.filter');
Route::get('/filter','App\Http\Controllers\PostsController@filter')->name('posts.filter');
Route::post('/posts/{skelbimoNr?}','App\Http\Controllers\PostsController@store')->name('posts.store');
//Route::get('/posts/{skelbimoNr}', 'App\Http\Controllers\PostsController@update');
//Route::get('/posts/{skelbimoNr}', 'App\Http\Controllers\PostsController@show');

Route::get('/index', function () {
    return view('ruddit.index');
});
Route::get('/content', function () {
    return view('ruddit.content');
});
Route::get('/profile', function () {
    return view('ruddit.profile');
});
Route::get('/reports', function () {
    return view('ruddit.reports');
});
Route::get('/login', function () {
    return view('ruddit.login');
});



Route::get('/register', function () {
    return view('ruddit.register');
});
Route::get('/awards', function () {
    return view('ruddit.awards');
});



Route::post('/comment/{skelbimoNr}','App\Http\Controllers\PostsController@comment');
Route::post('/like/{skelbimoNr}/{id}','App\Http\Controllers\PostsController@like');
Route::get('/like/{skelbimoNr}/{id}','App\Http\Controllers\PostsController@like');
Route::post('/comment/{skelbimoNr}','App\Http\Controllers\CommentsController@comment');
Route::post('/like/{skelbimoNr}/{id}','App\Http\Controllers\CommentsController@like');
Route::get('/like/{skelbimoNr}/{id}','App\Http\Controllers\CommentsController@like');

Route::match(array('PUT', 'PATCH'), "/comment/{id}", array(
    'uses' => 'App\Http\Controllers\CommentsController@rep',
    'as' => 'comments.rep'
));
//Route::get('/comment/{id}','App\Http\Controllers\CommentsController@rep');

Route::post('/raise/{id}','App\Http\Controllers\CommentsController@raise');
Route::get('/raise/{id}','App\Http\Controllers\CommentsController@raise');
//Route::post('/destroy/{id}/{ids}','App\Http\Controllers\PostsController@destroy');
//Route::get('/destroy/{id}/{ids}','App\Http\Controllers\PostsController@destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user/{id}','App\Http\Controllers\UserController@show');
Route::get('/edit/{id}','App\Http\Controllers\UserController@edit');
Route::get('/sendVerify/{id}', 'App\Http\Controllers\UserController@sendVerify');
Route::get('/receiveVerify/{id}', 'App\Http\Controllers\UserController@receiveVerify');
Route::resource('/auth', 'App\Http\Controllers\UserController');
Route::get('/verify', 'App\Http\Controllers\UserController@verify');

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

route::get('/send-mail',function(){
    $details=[
        'title'=>'mail form who is you',
        'body'=>'who is you why is you'
    ];
    Mail::to('eritar@ktu.lt')->send(new \App\Mail\ReportMail($details));
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/image-upload','ImageUploadController@index')->name('image.upload');
Route::get('/image-upload-list','ImageUploadController@List')->name('image.list');
Route::get('/image-upload-delete/{id}/bruh/{pht}','App\Http\Controllers\PostsController@destroyImage')->name('image.destroy');
Route::get('/bookposts','App\Http\Controllers\PostsController@bookmarks')->name('posts.bookmarks');
Route::get('/bookposts/{id}','App\Http\Controllers\PostsController@bookmark')->name('posts.bookmark');
Route::get('/cheap','App\Http\Controllers\PostsController@cheap')->name('posts.cheap');
Route::get('/gaming','App\Http\Controllers\PostsController@gaming')->name('posts.gaming');
Route::get('/bookmark/{id}','App\Http\Controllers\PostsController@bookfilter')->name('posts.bookfilter');