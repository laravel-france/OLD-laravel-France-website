<?php

Route::group(array('before' => 'isGuest'), function() {
	Route::get('login', function() {
	    return View::make('panel::login.login');
	});


	Route::post('login', function() {
		$from_url = Input::get('from_url', '/');
		try
		{
		    Auth::attempt(
		    	array(
		    		'username' => Input::get('username'),
		    		'password' => Input::get('password')
		    	)
		    );

		    return Redirect::to($from_url ? $from_url : '/');
		}
		catch (Exception $e)
		{
	    	Session::flash('from_url', $from_url);
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

	Route::get('panel', array('before' => 'auth', function(){

		return View::make('panel::panel.index');
	}));




	Route::get('panel/password', 'panel::password@show');
	Route::post('panel/password', 'panel::password@submit');

	Route::get('panel/site/users', 'panel::site@listusers');
	Route::get('panel/site/users/(:num)/edit', 'panel::site@editusers');
	Route::put('panel/site/users/(:num)', 'panel::site@updateusers');

});





Route::filter('isGuest', function()
{
	if (!Auth::guest()) return Redirect::to('/');
});



View::composer('panel::panel.layout', function($view)
{
    $view->with('user', Auth::user());
});
