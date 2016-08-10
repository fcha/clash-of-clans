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
		$this->getDb()->table('members')->insert($members);
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