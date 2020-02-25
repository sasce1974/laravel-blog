<?php

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

use App\Mail\firstMail;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
//    return view('welcome');
    return redirect(route('posts'));
});

Auth::routes();

Route::group(['middleware' => ['admin', 'auth', 'active']], function(){

    //Admin staff
    Route::get('admin', function (){
        return view('admin.index');
    })->name('admin');
    Route::resource('admin/users', 'AdminUsersController');
    Route::resource('admin/roles', 'AdminRolesController');
    Route::resource('admin/categories', 'AdminCategoriesController');

    Route::resource('admin/comments', 'AdminCommentsController');
    Route::resource('admin/replies', 'AdminRepliesController');
    Route::resource('admin/medias', 'AdminMediasController');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>['auth', 'active']], function (){
    //User controller...
    Route::get('users', 'AdminUsersController@index')->name('users');
    Route::get('show/user/{id}', 'UserController@show')->name('show_user');
    Route::get('edit/user', 'UserController@edit')->name('edit_user');
    Route::patch('update/user', 'UserController@update')->name('update_user');
    Route::delete('delete/user', 'UserController@destroy')->name('delete_user');

    //Post controller...
    Route::resource('admin/posts', 'AdminPostsController');


//    Route::get('show/posts', 'AdminPostsController@show')->name('show_post');
//    Route::get('add/post', 'AdminPostsController@create')->name('add_post');
//    Route::post('store/post', 'AdminPostsController@store')->name('store_post');


    Route::get('inbox', 'MessageController@index')->name('inbox');
    Route::get('new_message', 'MessageController@new')->name('new_message');
    Route::get('message_reply/{id}', 'MessageController@reply')->name('message_reply');
    Route::get('show_message/{id}', 'MessageController@show')->name('show_message');
    Route::get('sent_messages', 'MessageController@sent');
    Route::post('send_message', 'MessageController@send');
    Route::delete('delete_message/{id}', 'MessageController@destroy');

});

Route::get('/posts', 'AdminPostsController@all_posts')->name('posts');
Route::get('/post/{id}', 'AdminPostsController@post')->name('post');

Route::get('sessions', function(){
    session(['proba1'=> 'This is TEST!', 'proba2'=>'This is other TEST!!!']);
    return "<h1>" . session('proba1') . "</h1>";
});


//Route for sending mail...
Route::get('mail', function (){
    $con = @fsockopen('smtp.mailtrap.io', 2525);
    if($con) {
        Mail::to('admin@3delacto.com')->send(new firstMail);
        fclose($con);
        return '<h2>Mail Sent</h2>';
    }else{
        return "<h2>No connection to the server :(</h2>";
    }


});

Route::get('/search', 'SearchController@search');

