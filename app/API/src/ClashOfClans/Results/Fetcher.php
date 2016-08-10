<?php namespace App\API\src\ClashOfClans\Results;

use App\API\src\ClashOfClans\Results\Storage\Repositories\Eloquent\RepositoryInterface as Repository;

class Fetcher {

	/**
	 * @var  \App\API\src\ClashOfClans\Results\Storage\Repositories\Eloquent\RepositoryInterface
	 */
	protected $repository;

	/**
	 * @param  \App\API\src\ClashOfClans\Results\Storage\Repositories\Eloquent\RepositoryInterface    $repository
	 */
	public function __construct(Repository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Gets the clan  information
	 *
	 * @return array
	 */
	public function getActiveClanResults()
	{
		$typeId = config('api.results.types.clans');
		$statusId = config('api.results.statuses.active');

		return $this->repository->getResults($typeId, $statusId);
	}

}