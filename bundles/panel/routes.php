<?php

Route::get('profile/(:any)', 'panel::profile@index');
Route::get('profile/(:any)/github', 'panel::profile@github');

Route::group(array('before' => 'isGuest'), function() {

	Route::get('login', function() {
	    return View::make('panel::login.login');
	});

	Route::get('login/special', function() {
	    return View::make('panel::login.login_special');
	});

	Route::post('login', function() {
		$from_url = Session::get('from_url', URL::to_action('forums::home@index'));
		try
		{
		    Auth::attempt(
		    	array(
		    		'username' => Input::get('username'),
		    		'password' => Input::get('password'),
		    		'remember' => true,
		    	),
		    	true
		    );

		    Session::forget('from_url');
		    return Redirect::to($from_url ? $from_url : URL::to_action('forums::home@index'));
		}
		catch (Exception $e)
		{
	        return Redirect::to('login')
	            ->with('login_errors', true);
		}
	});
});

Route::group(array('before' => 'auth'), function() {
	Route::get('logout', function() {
	    Auth::logout();
	    return Redirect::to('login');
	});

	Route::get('panel', function(){
		return View::make('panel::panel.index');
	});

	Route::get('panel/application', 'panel::applications@show');

	Route::get('panel/avatar', 'panel::avatar@show');
	Route::post('panel/avatar', 'panel::avatar@submit');
});


Route::group(array('before' => 'superadmin'), function() {
	Route::get('panel/site/users', 'panel::site@listusers');
	Route::get('panel/site/users/(:num)/remove', 'panel::site@removeuser');
	Route::get('panel/site/users/(:num)/edit', 'panel::site@editusers');
	Route::put('panel/site/users/(:num)', 'panel::site@updateusers');
	Route::put('panel/site/users/(:num)/password', 'panel::site@updateuserpassword');
	Route::put('panel/site/users/(:num)/roles', 'panel::site@updateuserroles');

	Route::get('panel/site/roles', 'panel::site@listroles');
	Route::post('panel/site/roles', 'panel::site@newrole');
});



Route::filter('isGuest', function()
{
	if (!Auth::guest()) return Redirect::to('/');
});

Route::filter('superadmin', function()
{
	if (Auth::guest() || !Auth::user()->is('Super Admin')) {
		return Response::error('404');
	}
});


View::composer('panel::panel.layout', function($view)
{
    $view->with('user', Auth::user());
});
