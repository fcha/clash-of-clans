<?php namespace App\API\src\ClashOfClans\Fetchers;

use App\API\src\ClashOfClans\Storage\Repositories\Eloquent\RepositoryInterface as Fetcher;

class Clan {

	/**
	 * @var  \App\API\src\ClashOfClans\Storage\Repositories\Eloquent\RepositoryInterface
	 */
	protected $fetcher;

	/**
	 * @param  \App\API\src\ClashOfClans\Storage\Repositories\Eloquent\RepositoryInterface    $fetcher
	 */
	public function __construct(Fetcher $fetcher)
	{
		$this->fetcher = $fetcher;
	}

	/**
	 * Gets the clan  information
	 *
	 * @return array
	 */
	public function getClan()
	{
		$result = $this->fetcher->getClan();

		$this->formatResult($result);
	}

	/**
	 * Gets the clan  information
	 *
	 * @param  string    $result
	 *
	 * @return array
	 */
	public function formatResult($result)
	{
		debug_object(json_decode($result, true), true);
	}

}