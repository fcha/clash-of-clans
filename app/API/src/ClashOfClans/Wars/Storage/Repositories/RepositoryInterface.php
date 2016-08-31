<?php namespace App\API\src\ClashOfClans\Wars\Storage\Repositories;

interface RepositoryInterface {

	/**
	 * Save wars
	 *
	 * @param  array    $wars
	 */
	public function saveWars(array $wars);

}