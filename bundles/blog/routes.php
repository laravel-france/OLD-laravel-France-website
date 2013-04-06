<?php
namespace Blog;

use \Route;

Route::get('(:bundle)', 'blog::home@index');
Route::get('(:bundle)/articles.rss', 'blog::home@rss');
Route::get('(:bundle)/show/(:num)-(:any)', 'blog::home@show');
Route::get('(:bundle)/s/(:num)', 'blog::home@resolve');



Route::filter('pattern: blog/admin*', 'bloguser');
Route::controller('blog::admin.post');
Route::controller('blog::admin.category');
Route::controller('blog::admin');


Route::filter('bloguser', function()
{
	if (\Auth::guest() || !\Auth::user()->is('Blogger')) {
		return \Response::error('404');
	}
});