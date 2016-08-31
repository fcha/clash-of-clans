<?php namespace App\API\src\ClashOfClans\Wars;

use App\API\src\ClashOfClans\Wars\Storage\Repositories\RepositoryInterface as Repository;

class Saver {

	/**
	 * @var  \App\API\src\ClashOfClans\Wars\Storage\Repositories\RepositoryInterface
	 */
	protected $repository;

	/**
	 * @param  \App\API\src\ClashOfClans\Wars\Storage\Repositories\RepositoryInterface    $repository
	 */
	public function __construct(Repository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Save clan details
	 *
	 * @param  array    $clan
	 */
	public function save(array $clan)
	{
	}

}