<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Members
	|--------------------------------------------------------------------------
	|
	| Member config values
	|
	*/

	'roles' => [
		'leader' => 1,
		'coLeader' => 2,
		'elder' => 3,
		'member' => 4,
		'admin' => 5
	],

	'statuses' => [
		'active' => 1,
		'inactive' => 2,
	],

	'details' => [
		'statuses' => [
			'current' => 1,
			'active' => 2,
			'replaced' => 3
		]
	]
];