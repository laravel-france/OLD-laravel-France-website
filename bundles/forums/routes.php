<?php

Route::filter('pattern: forums/admin*', 'forumer');
Route::controller('forums::admin.category');
Route::controller('forums::admin');



// Index of the forums
Route::get(
	'(:bundle)', 
	array(
		'uses' => 'forums::home@index',
	)
);

Route::get(
	'(:bundle).rss', 
	array(
		'uses' => 'forums::home@rss',
	)
);

// View topics in a cat
Route::get(
	'(:bundle)/(:any)-c(:num)', 
	array(
		'uses' => 'forums::category@index',
	)
);

// View topics in a cat in rss
Route::get(
	'(:bundle)/(:any)-c(:num).rss', 
	array(
		'uses' => 'forums::category@rss',
	)
);

// Create a topic
Route::get(
	'(:bundle)/(:any)-c(:num)/topic/create', 
	array(
		'uses' => 'forums::topic@create',
		'before' => 'auth',
	)
);

// Post a topic
Route::post('(:bundle)/(:any)-c(:num)/topic/create', 
	array(
		'uses' => 'forums::topic@postcreate',
		'before' => 'csrf|auth',
	)
);

// Reply a message
Route::get(
	'(:bundle)/(:any)-t(:num)/reply', 
	array(
		'uses' => 'forums::topic@reply',
		'before' => 'auth',
	)
);

// Post reply
Route::post('(:bundle)/(:any)-t(:num)/reply', 
	array(
		'uses' => 'forums::topic@postreply',
		'before' => 'csrf|auth',
	)
);

// Edit a message
Route::get(
	'(:bundle)/(:any)-t(:num)/edit/(:num)', 
	array(
		'uses' => 'forums::topic@edit',
		'before' => 'auth',
	)
);

// Stick a message
Route::get(
	'(:bundle)/(:any)-t(:num)/toggleStick', 
	array(
		'uses' => 'forums::topic@toggle_sticky',
		'before' => 'auth',
	)
);

Route::post(
	'(:bundle)/(:any)-t(:num)/edit/(:num)', 
	array(
		'uses' => 'forums::topic@postedit',
		'before' => 'csrf|auth',
	)
);

// View topic
Route::get(
	'(:bundle)/(:any)-t(:num)', 
	array(
		'uses' => 'forums::topic@index',
	)
);

// View topic rss
Route::get(
	'(:bundle)/(:any)-t(:num).rss', 
	array(
		'uses' => 'forums::topic@rss',
	)
);

// Index of the forums
Route::get(
	'(:bundle)/posted', 
	array(
		'uses' => 'forums::posted@index',
	)
);


Route::filter('forumer', function()
{
	if (\Auth::guest() || !\Auth::user()->is('Forumer')) {
		return \Response::error('404');
	}
});