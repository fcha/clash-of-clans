<?php namespace App\API\src\ClashOfClans\Wars\Storage\Repositories;

use App\API\src\ClashOfClans\Wars\Storage\Entities\War;

class Repository implements RepositoryInterface {

	/**
	 * @var  \App\API\src\ClashOfClans\Wars\Storage\Entities\War
	 */
	protected $war;

	/**
	 * @var  \Formatter
	 */
	protected $formatter;

	/**
	 * @param  Formatter    $formatter
	 */
	public function __construct(Formatter $formatter)
	{
		$this->war = new War;
		$this->formatter = $formatter;
	}

	/**
	 * Save wars
	 *
	 * @param  array    $wars
	 */
	public function saveWars(array $wars)
	{
		$this->getDb()->table('wars')->insert($wars);
	}

	/**
	 * Gets the catalog db connection
	 *
	 * @return \Illuminate\Database\Connection
	 */
	protected function getDb()
	{
		return (new War)->getConnection();
	}

}