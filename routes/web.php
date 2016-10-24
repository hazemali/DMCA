<?php


Route::get('/', 'pagesController@home');

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::get('notices/create/confirm', 'noticesController@confirm');

Route::resource('notices','noticesController');
