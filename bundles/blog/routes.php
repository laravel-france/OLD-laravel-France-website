<?php
namespace Blog;

use \Route;

Route::get('(:bundle)', 'blog::home@index');
Route::get('(:bundle)/show/(:num)-(:any)', 'blog::home@show');

Route::get('(:bundle)/category/(:any)', 'blog::category@index');
