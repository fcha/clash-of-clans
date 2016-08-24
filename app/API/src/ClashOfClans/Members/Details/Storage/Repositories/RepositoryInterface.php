<?php namespace App\API\src\ClashOfClans\Members\Details\Storage\Repositories;

interface RepositoryInterface {

	/**
	 * Create member details
	 *
	 * @param  array    $memberDetails
	 */
	public function create(array $memberDetails);
}