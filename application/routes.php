<?php


Route::get('/', function()
{
    $posts = \Blog\Models\Post::order_by('created_at','desc')->take(5)->get();

    return View::make('home.index')
        ->with("posts", $posts);
});


Route::get('telecharger, download', array('as'=>'telecharger', function()
{
    return Redirect::to('http://laravel.com/download');
}));

Route::get('login', function() {
    return View::make('login.login');
});

Route::post('login', function() {
    if ( Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password'))))
    {
        return Redirect::to('/');
    }
    else
    {
        return Redirect::to('login')
            ->with('login_errors', true);
    }
});


Route::get('logout', function() {
    Auth::logout();
    return Redirect::to('login');
});




Route::controller(array('contact'));


Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});











Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});