<?php namespace App\API\src\ClashOfClans\Members\Storage\Repositories;

interface RepositoryInterface {

	/**
	 * Save members
	 *
	 * @param  array    $members
	 */
	public function saveMembers(array $members);

}