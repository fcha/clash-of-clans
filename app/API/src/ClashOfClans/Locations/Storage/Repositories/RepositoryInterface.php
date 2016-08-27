<?php namespace App\API\src\ClashOfClans\Locations\Storage\Repositories;

interface RepositoryInterface {

	/**
	 * Save locations
	 *
	 * @param  array    $locations
	 */
	public function saveLocations(array $locations);

}