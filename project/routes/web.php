<?php

Route::resource('user', 'UserController')->middleware('admin_permission');
Route::resource('apart', 'ApartController')->middleware('admin_permission');
Route::resource('cost', 'CostsController')->middleware('admin_permission');
Route::resource('room', 'RoomsController')->middleware('admin_permission');
Route::resource('bill', 'BillsController')->middleware('admin_permission');
Route::resource('board', 'BoardController')->middleware('admin_permission');
Route::resource('usermg', 'UserMgController')->middleware('admin_permission');
Route::patch('bill/update', 'BillsController@update2')->middleware('admin_permission');
Route::get('bill/print/{id}', 'BillsController@print')->middleware('admin_permission');

Route::get('/','loginController@home')->middleware('login_permission');
Route::get('login/', 'loginController@index');
Route::post('login/check', 'loginController@check');
Route::get('login/logout', 'loginController@logout');

Route::get('user/bill/{id}', 'UserController@bill')->middleware('user_permission');
Route::get('user/board', 'UserController@board')->middleware('login_permission');

Route::get('board/list/1', 'BoardController@list')->middleware('login_permission');
Route::get('board/view/{id}', 'BoardController@show')->middleware('login_permission');