<?php namespace App\API\src\ClashOfClans\Storage\Repositories\Eloquent;

use App\API\src\ClashOfClans\Storage\Entities\Result;

class Repository implements RepositoryInterface {

	/**
	 * @var  \App\API\src\ClashOfClans\Storage\Entities\Result
	 */
	protected $result;

	/**
	 * @param  Formatter    $formatter
	 */
	public function __construct()
	{
		$this->result = new Result;
		//$this->formatter = $formatter;
	}

	/**
	 * Save api results
	 *
	 * @param  int    $type
	 * @param  string    $results
	 */
	public function saveResults($type, $results)
	{
		$result = $this->result->create([
			'type_id' => $type,
			'result' => $results
		]);

		return $result->getKey();
	}

}