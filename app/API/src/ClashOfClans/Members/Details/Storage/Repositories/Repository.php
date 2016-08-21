<?php namespace App\API\src\ClashOfClans\Members\Details\Storage\Repositories;

use App\API\src\ClashOfClans\Members\Details\Storage\Entities\MemberDetail;

class Repository implements RepositoryInterface {

	/**
	 * @var  \App\API\src\ClashOfClans\Members\Details\Storage\Entities\MemberDetail
	 */
	protected $memberDetail;

	public function __construct()
	{
		$this->memberDetail = new MemberDetail;
	}

	/**
	 * Create member details
	 *
	 * @param  array    $memberDetails
	 */
	public function create(array $memberDetails)
	{
		if (!$chunks = array_chunk($parameters, 1000))
			return;

		foreach ($chunks as $chunk)
		{
			$this->getDb()->table('member_details')->insert($chunk);
		}
	}

}