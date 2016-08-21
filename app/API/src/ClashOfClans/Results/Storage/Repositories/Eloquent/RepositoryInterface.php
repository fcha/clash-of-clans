<?php namespace App\API\src\ClashOfClans\Results\Storage\Repositories\Eloquent;

interface RepositoryInterface {

	/**
	 * Save api results
	 *
	 * @param  int       $type
	 * @param  int       $status
	 * @param  string    $results
	 */
	public function saveResults($type, $status, $results);

	/**
	 * Get active results
	 *
	 * @param  int    $typeId
	 * @param  int    $statusId
	 * @param  int    $limit
	 *
	 * @return array
	 */
	public function getResults($typeId, $statusId, $limit);

	/**
	 * Set result status
	 *
	 * @param  int    $id
	 * @param  int    $statusId
	 *
	 * @return array
	 */
	public function setStatus($id, $statusId);

	/**
	 * Get recent result
	 *
	 * @param  int    $typeId
	 * @param  int    $statusId
	 *
	 * @return array
	 */
	public function getRecentResult($typeId, $statusId);
}