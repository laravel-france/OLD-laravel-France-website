<?php


Route::get('(:bundle)', 'forums::home@index');
Route::get('(:bundle)/(:num)-(:any)', 'forums::category@index');
Route::get('(:bundle)/(:num)-(:any)/topic/create', 'forums::topic@create');
Route::get('(:bundle)/(:num)-(:any)/(:num)-(:any)', 'forums::topic@index');

