<?php namespace App\API\src\ClashOfClans\Clan;

use App\API\src\ClashOfClans\Clan\Storage\Repositories\RepositoryInterface as Repository;

class Fetcher {

	/**
	 * @var  \App\API\src\ClashOfClans\Clan\Storage\Repositories\RepositoryInterface
	 */
	protected $repository;

	/**
	 * @param  \App\API\src\ClashOfClans\Clan\Storage\Repositories\RepositoryInterface    $repository
	 */
	public function __construct(Repository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Fetch clan details
	 *
	 * @return array
	 */
	public function fetch()
	{
		return $this->repository->fetch();
	}

}