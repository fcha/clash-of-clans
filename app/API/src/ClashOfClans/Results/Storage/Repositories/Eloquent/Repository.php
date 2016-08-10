<?php namespace App\API\src\ClashOfClans\Results\Storage\Repositories\Eloquent;

use App\API\src\ClashOfClans\Results\Storage\Entities\Result;

class Repository implements RepositoryInterface {

	/**
	 * @var  \App\API\src\ClashOfClans\Results\Storage\Entities\Result
	 */
	protected $result;

	/**
	 * @var  \Formatter
	 */
	protected $formatter;

	/**
	 * @param  Formatter    $formatter
	 */
	public function __construct(Formatter $formatter)
	{
		$this->result = new Result;
		$this->formatter = $formatter;
	}

	/**
	 * Save api results
	 *
	 * @param  int       $type
	 * @param  int       $status
	 * @param  string    $results
	 */
	public function saveResults($type, $status, $results)
	{
		$result = $this->result->create([
			'type_id' => $type,
			'status_id' => $status,
			'result' => $results
		]);

		return $result->getKey();
	}

	/**
	 * Get active clan results
	 *
	 * @param  int    $typeId
	 * @param  int    $statusId
	 *
	 * @return array
	 */
	public function getResults($typeId, $statusId)
	{
		if (!$results = $this->result->whereTypeId($typeId)->whereStatusId($statusId)->get())
			return [];

		return $this->formatter->formatResults($results);
	}

	/**
	 * Set result status
	 *
	 * @param  int    $id
	 * @param  int    $statusId
	 */
	public function setStatus($id, $statusId)
	{
		$result = $this->result->find($id);

		$result->status_id = $statusId;
		$result->save();
	}

	/**
	 * Get recent result
	 *
	 * @param  int    $typeId
	 * @param  int    $statusId
	 *
	 * @return array
	 */
	public function getRecentResult($typeId, $statusId)
	{
		if (!$result = $this->result->whereTypeId($typeId)->whereStatusId($statusId)->orderBy('created_at', 'DESC')->first())
			return [];

		return $this->formatter->formatResult($result);
	}
}