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
	$trophyImage = url('assets/images/trophy.png');

    return view('members/members', ['members' => $members, 'trophyImage' => $trophyImage]);
});