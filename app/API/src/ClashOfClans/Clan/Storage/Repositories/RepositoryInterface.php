<?php namespace App\API\src\ClashOfClans\Clan\Storage\Repositories;

interface RepositoryInterface {

	/**
	 * Save clan
	 *
	 * @param  array    $clan
	 */
	public function save(array $clan);

}