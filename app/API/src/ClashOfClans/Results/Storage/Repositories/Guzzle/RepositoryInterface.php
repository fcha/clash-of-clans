<?php namespace App\API\src\ClashOfClans\Results\Storage\Repositories\Guzzle;

interface RepositoryInterface {

	/**
	 * Get clan information
	 *
	 * @return array
	 */
	public function getClan();

	/**
	 * Get leagues information
	 *
	 * @return array
	 */
	public function getLeagues();

	/**
	 * Get location information
	 *
	 * @return array
	 */
	public function getLocations();

	/**
	 * Get clan warlog information
	 *
	 * @return string
	 */
	public function getWarLog();

}