<?php

return array(
	'login'        => 'login',

	'callback'     => 'oneauth/callback',
	
	'registered'   => function() {
		$from_url = Session::get('from_url', URL::to_action('forums::home@index'));
		Session::forget('from_url');
		return $from_url;
	},
	'logged_in'    => function() {
		$from_url = Session::get('from_url', URL::to_action('forums::home@index'));
		Session::forget('from_url');
		return $from_url;
	},
);