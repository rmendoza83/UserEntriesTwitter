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

Route::get('/', function () {
    return redirect()->home();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Routes for Twitter
Route::get('/twitter/{id}', 'TwitterController@get');
Route::get('/twitter', 'TwitterController@list');
// Routes for Entries
Route::get('/entries/all', 'EntryController@all');
Route::get('/entries/{id}', 'EntryController@get');
Route::get('/entries/list/{id}', 'EntryController@list');
Route::post('/entries', 'EntryController@insert');
Route::put('/entries/{id}', 'EntryController@update');
Route::delete('/entries/{id}', 'EntryController@delete');
// Routes for Hided Tweets
Route::get('/hidedtweet/{id}', 'HidedTweetController@get');
Route::get('/hidedtweet', 'HidedTweetController@list');
Route::post('/hidedtweet', 'HidedTweetController@insert');
Route::delete('/hidedtweet/{id}', 'HidedTweetController@delete');

