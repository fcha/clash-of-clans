<?php namespace App\API\src\ClashOfClans\Storage\Repositories\Eloquent;

interface RepositoryInterface {

	/**
	 * Save api results
	 *
	 * @param  int    $type
	 * @param  string    $results
	 */
	public function saveResults($type, $results);

}