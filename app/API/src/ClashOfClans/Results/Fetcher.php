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
	 * Gets the clan results information
	 *
	 * @return array
	 */
	public function getActiveClanResults()
	{
		$typeId = config('api.results.types.clans');
		$statusId = config('api.results.statuses.active');

		return $this->repository->getResults($typeId, $statusId);
	}

	/**
	 * Gets the recent league results information
	 *
	 * @return array
	 */
	public function getRecentActiveLeagueResults()
	{
		$typeId = config('api.results.types.leagues');
		$statusId = config('api.results.statuses.active');

		$recentResult = $this->repository->getRecentResult($typeId, $statusId);

		$statusId = config('api.results.statuses.completed');
		$completedResult = $this->repository->getRecentResult($typeId, $statusId);

		if (array_get($completedResult, 'id', 0) >= array_get($recentResult, 'id', 0))
			return [];

		return $recentResult;
	}

	/**
	 * Get the recent clan result information
	 *
	 * @return array
	 */
	public function getRecentCompletedClanResult()
	{
		$typeId = config('api.results.types.clans');
		$statusId = config('api.results.statuses.completed');

		$recentResult = $this->repository->getRecentResult($typeId, $statusId);

		return array_get($recentResult, 'id');
	}

}