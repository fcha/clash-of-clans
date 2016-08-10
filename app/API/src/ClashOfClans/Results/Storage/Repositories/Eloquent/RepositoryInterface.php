<?php namespace App\API\src\ClashOfClans\Results\Storage\Repositories\Eloquent;

interface RepositoryInterface {

	/**
	 * Save api results
	 *
	 * @param  int       $type
	 * @param  string    $results
	 */
	public function saveResults($type, $results);

	/**
	 * Get active clan results
	 *
	 * @param  int    $typeId
	 * @param  int    $statusId
	 *
	 * @return array
	 */
	public function getResults($typeId, $statusId);

	/**
	 * Set result status
	 *
	 * @param  int    $id
	 * @param  int    $statusId
	 *
	 * @return array
	 */
	public function setStatus($id, $statusId);

}