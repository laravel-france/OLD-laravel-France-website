<?php

Route::get('(:bundle)', 'forums::home@index');
Route::get('(:bundle)/(:num)-(:any)', 'forums::category@index');

Route::get('(:bundle)/(:num)-(:any)/topic/create', 'forums::topic@create');
Route::post('(:bundle)/(:num)-(:any)/topic/create', 'forums::topic@postcreate');

Route::get('(:bundle)/(:num)-(:any)/(:num)-(:any)/reply', 'forums::topic@reply');
Route::post('(:bundle)/(:num)-(:any)/(:num)-(:any)/reply', 'forums::topic@postreply');

Route::get('(:bundle)/(:num)-(:any)/(:num)-(:any)', 'forums::topic@index');
