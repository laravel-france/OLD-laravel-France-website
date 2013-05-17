<?php

return array(
	/**
	 * Providers
	 *
	 * Providers such as Facebook, Twitter, etc all use different Strategies such as oAuth, oAuth2, etc.
	 * oAuth takes a key and a secret, oAuth2 takes a (client) id and a secret, optionally a scope.
	 */
	'providers' => array(

		'github' => array(
			'id'     => '4f904d8022cc8a454d09',
			'secret' => '76ae30937da6086210b90fe6a238c2ed1da9e93f',
            'scope'  => 'user:email'
		),

		'google' => array(
			'id'     => '718908900119.apps.googleusercontent.com',
			'secret' => 'DgV2a4BeRy5hLi8c7tmg-ksu',
		),

		'twitter' => array(
			'key'    => 'RFOaLSbleO9kSTYPGvLnUw',
			'secret' => 'kRMih2o4OuSxcsjjuBx6N9OBRirUpnWr3kT6hjc9xw',
		),
	),
);