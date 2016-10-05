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

//Route for the home page
Route::get('/', 'PagesController@home');

// Route for the contact page
Route::get('/ticket', 'TicketsController@ticket');

// Route for the contact page
Route::get('/about', 'PagesController@about');

Route::post('/ticket', 'TicketsController@store');

Route::get('/tickets', 'TicketsController@index');

Route::get('/ticket/{id}', 'TicketsController@show');

Route::get('/ticket/{id}/edit', 'TicketsController@edit');

Route::post('/ticket/{id}/edit', 'TicketsController@update');

Route::post('/ticket/{id}/delete', 'TicketsController@destroy');

Route::post('/comment', 'CommentsController@newComment');
