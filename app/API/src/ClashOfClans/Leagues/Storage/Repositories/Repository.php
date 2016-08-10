<?php namespace App\API\src\ClashOfClans\Leagues\Storage\Repositories;

use App\API\src\ClashOfClans\Leagues\Storage\Entities\League;

class Repository implements RepositoryInterface {

	/**
	 * @var  \App\API\src\ClashOfClans\Leagues\Storage\Entities\League
	 */
	protected $league;

	/**
	 * @var  \Formatter
	 */
	protected $formatter;

	/**
	 * @param  Formatter    $formatter
	 */
	public function __construct(Formatter $formatter)
	{
		$this->league = new League;
		$this->formatter = $formatter;
	}

	/**
	 * Save leagues
	 *
	 * @param  array    $leagues
	 */
	public function saveLeagues(array $leagues)
	{
		$this->getDb()->table('leagues')->insert($leagues);
	}

	/**
	 * Gets the catalog db connection
	 *
	 * @return \Illuminate\Database\Connection
	 */
	protected function getDb()
	{
		return (new League)->getConnection();
	}

}