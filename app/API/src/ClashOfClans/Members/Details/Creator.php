<?php namespace App\API\src\ClashOfClans\Members\Details;

use App\API\src\ClashOfClans\Members\Details\Storage\Repositories\RepositoryInterface as Repository;

class Creator {

	/**
	 * @var  \App\API\src\ClashOfClans\Members\Details\Storage\Repositories\RepositoryInterface
	 */
	protected $repository;

	/**
	 * @param  \App\API\src\ClashOfClans\Members\Details\Storage\Repositories\RepositoryInterface    $repository
	 */
	public function __construct(Repository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Create member details
	 *
	 * @param  array    $details
	 *
	 * @return array
	 */
	public function create(array $details)
	{
		return $this->repository->create($details);
	}
}