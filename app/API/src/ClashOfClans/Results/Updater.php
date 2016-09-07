<?php namespace App\API\src\ClashOfClans\Results;

use App\API\src\ClashOfClans\Results\Storage\Repositories\Eloquent\RepositoryInterface as Repository;

class Updater {

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
	 * @param  array    $results
	 *
	 * @return array
	 */
	public function completeResults(array $results)
	{
		$completedStatusId = config('api.results.statuses.completed');

		foreach ($results as $id)
		{
			$this->repository->setStatus($id, $completedStatusId);
		}
	}

}