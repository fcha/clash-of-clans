<?php namespace App\API\src\ClashOfClans\Leagues\Storage\Repositories;

interface RepositoryInterface {

	/**
	 * Save leagues
	 *
	 * @param  array    $leagues
	 */
	public function saveLeagues(array $leagues);

}