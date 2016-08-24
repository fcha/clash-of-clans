<?php namespace App\API\src\ClashOfClans\Members\Details;

use App\API\src\ClashOfClans\Members\Fetcher as MemberFetcher;
use App\API\src\ClashOfClans\Members\Details\Storage\Repositories\RepositoryInterface as Repository;

class Creator {

	/**
	 * @var  \App\API\src\ClashOfClans\Members\Details\Storage\Repositories\RepositoryInterface
	 */
	protected $repository;

	/**
	 * @var  \App\API\src\ClashOfClans\Members\Fetcher
	 */
	protected $memberFetcher;

	/**
	 * @var  array
	 */
	protected $members;

	/**
	 * @param  \App\API\src\ClashOfClans\Members\Details\Storage\Repositories\RepositoryInterface    $repository
	 * @param  \App\API\src\ClashOfClans\Members\Fetcher                                             $memberFetcher
	 */
	public function __construct(Repository $repository, MemberFetcher $memberFetcher)
	{
		$this->repository = $repository;
		$this->memberFetcher = $memberFetcher;
	}

	/**
	 * Create member details
	 *
	 * @param  array    $details
	 */
	public function create(array $details)
	{
		//get members
		$this->members = array_index($this->memberFetcher->getSimpleMembers(), 'tag');

		//format details
		if (!$formattedDetails = $this->formatDetails($details))
			return;

		return $this->repository->create($formattedDetails);
	}

	/**
	 * Format details
	 *
	 * @param  array    $details
	 *
	 * @return  array
	 */
	protected function formatDetails(array $details)
	{
		$formattedDetails = [];

		foreach ($details as $detail)
		{
			$formattedDetails[] = $this->formatDetail($detail);
		}

		return $formattedDetails;
	}

	/**
	 * Format detail
	 *
	 * @param  array    $detail
	 *
	 * @return  array
	 */
	protected function formatDetail(array $detail)
	{
		return [
			'result_id' => array_get($detail, 'result_id'),
			'role_id' => array_get($detail, 'role_id'),
			'member_id' => array_get($this->members, array_get($detail, 'tag') . '.id'),
			'experience' => array_get($detail, 'experience'),
			'league_id' => array_get($detail, 'league_id'),
			'trophies' => array_get($detail, 'trophies'),
			'current_rank' => array_get($detail, 'current_rank'),
			'previous_rank' => array_get($detail, 'previous_rank'),
			'troops_donated' => array_get($detail, 'troops_donated'),
			'troops_received' => array_get($detail, 'troops_received'),
			'created_at' => array_get($detail, 'created_at')
		];
	}
}