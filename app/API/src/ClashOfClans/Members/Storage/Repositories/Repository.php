<?php namespace App\API\src\ClashOfClans\Members\Storage\Repositories;

use App\API\src\ClashOfClans\Members\Storage\Entities\Member;

class Repository implements RepositoryInterface {

	/**
	 * @var  \App\API\src\ClashOfClans\Members\Storage\Entities\Member
	 */
	protected $member;

	/**
	 * @var  \Formatter
	 */
	protected $formatter;

	/**
	 * @param  Formatter    $formatter
	 */
	public function __construct(Formatter $formatter)
	{
		$this->member = new Member;
		$this->formatter = $formatter;
	}

	/**
	 * Save members
	 *
	 * @param  array    $members
	 */
	public function saveMembers(array $members)
	{
		if (!$chunks = array_chunk($members, 1000))
			return;

		foreach ($chunks as $chunk)
		{
			$this->getDb()->table('members')->insert($chunk);
		}
	}

	/**
	 * Get members
	 *
	 * @param  int    $resultId
	 *
	 * @return array
	 */
	public function getMembers($resultId)
	{
		if (!$members = $this->member->with('league', 'role')->where('result_id', $resultId)->get())
			return [];

		return $this->formatter->formatMembers($members);
	}

	/**
	 * Gets the catalog db connection
	 *
	 * @return \Illuminate\Database\Connection
	 */
	protected function getDb()
	{
		return (new Member)->getConnection();
	}

}