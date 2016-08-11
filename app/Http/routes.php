<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	$fetcher = App::make('App\API\src\ClashOfClans\Members\Fetcher');
	$members = $fetcher->getMembers();
	$images = [
		'trophy' => url('assets/images/trophy.png'),
		'rank' => [
			'equal' => url('assets/images/equal.png'),
			'up' => url('assets/images/up.png'),
			'down' => url('assets/images/down.png')
		]
	];

    return view('members/members', ['members' => $members, 'images' => $images]);
});