<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes for Twitter
Route::get('/twitter/{id}', 'TwitterController@get');
// Routes for Entries
Route::get('/entries', 'EntryController@all');
Route::get('/entries/list/{id}', 'EntryController@list');
// Routes for Hided Tweets
Route::get('/hidedtweet/{id}', 'HidedTweetController@get');
Route::get('/hidedtweet', 'HidedTweetController@list');
Route::post('/hidedtweet', 'HidedTweetController@insert');
Route::delete('/hidedtweet/{id}', 'HidedTweetController@delete');
// Routes for Users
Route::get('/users/{id}', 'UserController@get');
