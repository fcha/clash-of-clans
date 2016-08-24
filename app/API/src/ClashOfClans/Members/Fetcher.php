<?php namespace App\API\src\ClashOfClans\Members;

use App\API\src\ClashOfClans\Members\Storage\Repositories\RepositoryInterface as Repository;

class Fetcher {

	/**
	 * @var  \App\API\src\ClashOfClans\Members\Storage\Repositories\RepositoryInterface
	 */
	protected $repository;

	/**
	 * @param  \App\API\src\ClashOfClans\Members\Storage\Repositories\RepositoryInterface    $repository
	 */
	public function __construct(Repository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Gets the active clan members
	 *
	 * @return array
	 */
	public function getActiveMembers()
	{
		$active = config('api.members.statuses.active');

		return $this->repository->getMembers($active);
	}

	/**
	 * Get simple members
	 *
	 * @return array
	 */
	public function getSimpleMembers()
	{
		return $this->repository->getSimpleMembers();
	}

}