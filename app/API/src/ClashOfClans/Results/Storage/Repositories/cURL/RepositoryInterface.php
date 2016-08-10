<?php namespace App\API\src\ClashOfClans\Results\Storage\Repositories\cURL;

interface RepositoryInterface {

	/**
	 * Get clan information
	 *
	 * @return array
	 */
	public function getClan();

	/**
	 * Get leauges information
	 *
	 * @return array
	 */
	public function getLeagues();

}