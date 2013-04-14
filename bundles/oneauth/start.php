<?php

/*
|--------------------------------------------------------------------------
| OneAuth Library
|--------------------------------------------------------------------------
|
| Map OneAuth Library using PSR-0 standard namespace. 
|
*/

Autoloader::namespaces(array(
	'OneAuth\\Auth'   => Bundle::path('oneauth').'libraries'.DS.'auth',
	'OneAuth\\OAuth'  => Bundle::path('oneauth').'libraries'.DS.'oauth',
	'OneAuth\\OAuth2' => Bundle::path('oneauth').'libraries'.DS.'oauth2',
));

/*
|--------------------------------------------------------------------------
| OneAuth Events Listener
|--------------------------------------------------------------------------
|
| Lets listen to when OneAuth logged a user using any of the supported 
| providers. 
|
| OneAuth also listen to when user actually logged in to Laravel.
|
*/

Event::listen('oneauth.logged', function ($client, $user_data)
{
	// if user already logged in, don't do anything
	if (IoC::resolve('oneauth.driver: auth.check')) return ;

	// OneAuth should login the user if user exist and is not logged in
	if (is_numeric($client->user_id) and $client->user_id > 0)
	{
		$user = User::find($client->user_id);

		if ($user_data["provider"] == "twitter") {
			$user->twitter_url = $user_data["info"]["urls"]["twitter"];
		} elseif ($user_data["provider"] == "github") {
			$user->github_url = $user_data["info"]["urls"]["github"];
		} elseif ($user_data["provider"] == "google") {
			$user->googleplus_url = $user_data["info"]["urls"]["googleplus"];
		}

		if ($user->dirty()) {
			$user->save();
		}

		IoC::resolve('oneauth.driver: auth.login', array($client->user_id));
	}
	else // Or Create it
	{
		$userData = array(
			"username" => $user_data["info"]["nickname"],
			'verified' => 1,
			"email" => (isset($user_data["info"]["email"]) ? $user_data["info"]["email"] : null),
		);

		if ($user_data["provider"] == "twitter") {
			$userData["email"] = $user_data["info"]["nickname"]."@fillme.twitter";
			$userData["twitter_url"] = $user_data["info"]["urls"]["twitter"];
		} elseif ($user_data["provider"] == "github") {
			$userData["github_url"] = $user_data["info"]["urls"]["github"];
		} elseif ($user_data["google"]) {
			$userData["googleplus_url"] = $user_data["info"]["urls"]["googleplus"];
		}

		$user = new User;
		$user->fill($userData, true);
		$user->save();

		$client->user_id = $user->id;
		$client->save();


		Auth::login($user->id, true);
	}
});

Event::listen('oneauth.sync', function ($user_id)
{
	OneAuth\Auth\Core::sync($user_id);
});



Event::listen('laravel.auth: login', function()
{
	$user = IoC::resolve('oneauth.driver: auth.user');

	Event::fire('oneauth.sync', array($user->id));
});

Event::listen('laravel.auth: logout', function ()
{
	Session::forget('oneauth');
});

/*
|--------------------------------------------------------------------------
| OneAuth IoC
|--------------------------------------------------------------------------
|
| Register Auth adapter as IoC, allow it to be replaced by any Authentication
| bundle that doesn't use Laravel\Auth\Drivers.
|
*/

if ( ! IoC::registered('oneauth.driver: auth.check'))
{
	// Check whether current user is logged-in to the system or a guest
	IoC::register('oneauth.driver: auth.check', function ()
	{
		return Auth::check();
	});
}

if ( ! IoC::registered('oneauth.driver: auth.user'))
{
	// Get logged in user, if the user doesn't logged in yet, return null
	IoC::register('oneauth.driver: auth.user', function ()
	{
		return Auth::user();
	});
}

if ( ! IoC::registered('oneauth.driver: auth.login'))
{
	// Login the user by users.id
	IoC::register('oneauth.driver: auth.login', function ($user_id)
	{
		return Auth::login($user_id, true);
	});
}
