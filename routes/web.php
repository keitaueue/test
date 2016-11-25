<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
/*
Route::group(['middleware' => ['web']], function () {
*/

    // 権限機能
    //Route::controller('auth', 'Auth/LoginController');
    // Authentication routes...
    // Laravel5.3の場合。5.2等ではファンクション名が異なるので注意
    Route::get('/login', 'Auth\LoginController@showLoginForm');
    Route::post('auth/login', 'Auth\LoginController@login');
    Route::get('auth/logout', 'Auth\LoginController@logout');

    // Registration routes...
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm');
    Route::get('auth/register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('/register', 'Auth\RegisterController@register');
    Route::post('auth/register', 'Auth\RegisterController@register');

    // ブログ機能
    Route::resource('articles', 'ArticlesController');
//    //勉強用としてハードコーディング
//    Route::get('/articles/create', ['as' => 'articles.create', 'uses' => 'ArticlesController@create']);
//    Route::post('/articles', ['as' => 'articles.store', 'uses' => 'ArticlesController@store']);
//    Route::get('/articles/{id}/edit', ['as' => 'articles.edit', 'uses' => 'ArticlesController@edit']);
//    Route::patch('/articles/{id}', ['as' => 'articles.update', 'uses' => 'ArticlesController@update']);
//    Route::delete('/articles/{id}', ['as' => 'articles.destroy', 'uses' => 'ArticlesController@destroy']);
//    Route::get('/articles/{id}', ['as' => 'articles.show', 'uses' => 'ArticlesController@show']);
//    Route::get('/articles', ['as' => 'articles.index', 'uses' => 'ArticlesController@index']);
    Route::get('/', ['as' => 'index', 'uses' => 'ArticlesController@index']);

/*
});
*/
    use App\Services\Messenger\Messenger;
    Route::get('send_message/{message}', function(Messenger $messenger, $message){
        return $messenger->send($message);
    });
    
    

/*
Route::get('/', function () {
    return view('welcome');
});
*/

//Auth::routes();
//
//Route::get('/home', 'HomeController@index');
