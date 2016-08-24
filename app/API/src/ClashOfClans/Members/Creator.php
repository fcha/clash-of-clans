<?php namespace App\API\src\ClashOfClans\Members;

use App\API\src\ClashOfClans\Members\Storage\Repositories\RepositoryInterface as Repository;

class Creator {

	/**
	 * @var  \App\API\src\ClashOfClans\Members\Storage\Repositories\RepositoryInterface
	 */
	protected $repository;

	/**
	 * @var  \Fetcher
	 */
	protected $fetcher;

	/**
	 * @param  \App\API\src\ClashOfClans\Members\Storage\Repositories\RepositoryInterface    $repository
	 * @param  \Fetcher                                                                      $fetcher
	 */
	public function __construct(Repository $repository, Fetcher $fetcher)
	{
		$this->repository = $repository;
		$this->fetcher = $fetcher;
	}

	/**
	 * Create new members
	 *
	 * @param  array    $members
	 */
	public function create(array $members)
	{
		//get new members
		$newMembers = $this->getNewMembers($members);

		//create new members
		$this->repository->create($newMembers);
	}

	/**
	 * Get new members
	 *
	 * @param  array    $members
	 *
	 * @return array
	 */
	public function getNewMembers(array $members)
	{
		$existingMembers = array_index($this->fetcher->getSimpleMembers(), 'tag');
		$members = array_index($members, 'tag');

		return array_diff_key($members, $existingMembers);
	}

}