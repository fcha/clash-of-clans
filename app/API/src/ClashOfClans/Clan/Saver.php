<?php namespace App\API\src\ClashOfClans\Clan;

use App\API\src\ClashOfClans\Clan\Storage\Repositories\RepositoryInterface as Repository;

class Saver {

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
	 * Save clan details
	 *
	 * @param  array    $clan
	 */
	public function save(array $clan)
	{
		if ($this->repository->fetch())
			$this->repository->save($clan);
		else
			$this->repository->create($clan);
	}

}