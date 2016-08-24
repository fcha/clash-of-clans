<?php namespace App\API\src\ClashOfClans\Clan\Storage\Repositories;

interface RepositoryInterface {


	/**
	 * Fetch clan
	 */
	public function fetch();

	/**
	 * Create clan
	 *
	 * @param  array    $clanDetails
	 */
	public function create(array $clanDetails);

	/**
	 * Save clan
	 *
	 * @param  array    $clanDetails
	 */
	public function save(array $clanDetails);

}