<?php namespace App\API\src\ClashOfClans\Locations\Storage\Repositories;

use App\API\src\ClashOfClans\Locations\Storage\Entities\Location;

class Repository implements RepositoryInterface {

	/**
	 * @var  \App\API\src\ClashOfClans\Locations\Storage\Entities\League
	 */
	protected $location;

	public function __construct()
	{
		$this->location = new Location;
	}

	/**
	 * Save locations
	 *
	 * @param  array    $locations
	 */
	public function saveLocations(array $locations)
	{
		$this->getDb()->table('locations')->insert($locations);
	}

	/**
	 * Gets the catalog db connection
	 *
	 * @return \Illuminate\Database\Connection
	 */
	protected function getDb()
	{
		return (new Location)->getConnection();
	}

}