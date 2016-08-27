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

Route::get('/', function ()
{
	$fetcher = App::make('App\API\src\ClashOfClans\Clan\Fetcher');
	$clan = $fetcher->fetch();

    return view('details/details', ['clan' => $clan]);
});

Route::get('members', function ()
{
	$fetcher = App::make('App\API\src\ClashOfClans\Members\Fetcher');
	$members = $fetcher->getActiveMembers();
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

Route::get('test/result', function ()
{
	$fetcher = App::make('App\API\src\ClashOfClans\Results\Fetcher');
	debug_object($fetcher->getActiveClanResults());
});

Route::get('test/members', function ()
{
	$fetcher = App::make('App\API\src\ClashOfClans\Members\Fetcher');
	debug_object($fetcher->getActiveMembers());
});

Route::get('test/clan', function ()
{
	$fetcher = App::make('App\API\src\ClashOfClans\Clan\Fetcher');
	debug_object($fetcher->fetch());
});

Route::get('test/clanResults', function ()
{
	$fetcher = App::make('App\API\src\ClashOfClans\Results\Fetcher');
	debug_object($fetcher->getActiveClanResults());
});