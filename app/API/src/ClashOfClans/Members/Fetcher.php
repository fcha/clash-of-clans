<?php namespace App\API\src\ClashOfClans\Members;

use App\API\src\ClashOfClans\Results\Fetcher as ResultFetcher;
use App\API\src\ClashOfClans\Members\Storage\Repositories\RepositoryInterface as Repository;

class Fetcher {

	/**
	 * @var  \App\API\src\ClashOfClans\Members\Storage\Repositories\RepositoryInterface
	 */
	protected $repository;

	/**
	 * @var  \App\API\src\ClashOfClans\Results\Fetcher
	 */
	protected $resultFetcher;

	/**
	 * @param  \App\API\src\ClashOfClans\Members\Storage\Repositories\RepositoryInterface    $repository
	 * @param  \App\API\src\ClashOfClans\Members\Storage\Repositories\RepositoryInterface    $resultFetcher
	 */
	public function __construct(Repository $repository, ResultFetcher $resultFetcher)
	{
		$this->repository = $repository;
		$this->resultFetcher = $resultFetcher;
	}

	/**
	 * Gets the clan members
	 *
	 * @return array
	 */
	public function getMembers()
	{
		if (!$resultId = $this->resultFetcher->getRecentCompletedClanResult())
			return [];

		return $this->repository->getMembers($resultId);
	}

}