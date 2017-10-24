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

Route::get('/', 'HomeController@index');

Route::get('/questions/ask', 'QuestionController@showAsk');
Route::post('/questions/ask', 'QuestionController@ask')->name('questions.ask');
Route::post('/questions/answer', 'QuestionController@answer')->name('questions.answer');
Route::post('/questions/comment', 'QuestionController@comment')->name('questions.comment');
Route::get('/questions/{id}/{slug}', 'QuestionController@showQuestionDetail');
Route::get('/questions/list', 'QuestionController@showQuestionList');

Route::get('/answer/{id}/edit','QuestionController@showEditAnswer');
Route::post('/answer/edit', 'QuestionController@editAnswer')->name('answer.edit');

Route::get('/question/{id}/edit','QuestionController@showEditQuestion');
Route::post('/question/edit', 'QuestionController@editQuestion')->name('questions.edit');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/question/{id}', 'QuestionController@getQuestionById');
Route::get('/answers/{id}', 'QuestionController@getAnswersById');
Route::post('/vote_action', 'QuestionController@voteAction')->middleware('auth');
Route::post('/accept_answer', 'QuestionController@acceptAnswer')->middleware('auth');

Route::get('/tag/{tag}','QuestionController@showQuestionByTag');

Route::get('/users/{id}', 'UserController@showProfile');

Route::get('/user/{id}/view', 'UserController@viewOtherProfile');

Route::post('/user/upload_avatar', 'UserController@uploadAvatar');
Route::post('/user/update_profile', 'UserController@updateProfile');

Route::get('/user/isAuthenticated', 'UserController@isAuthenticated');
Route::get('/user/getCurrentUserId','UserController@getCurrentUserId');


