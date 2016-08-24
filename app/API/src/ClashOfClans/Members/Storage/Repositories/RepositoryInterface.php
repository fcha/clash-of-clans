<?php namespace App\API\src\ClashOfClans\Members\Storage\Repositories;

interface RepositoryInterface {

	/**
	 * Create members
	 *
	 * @param  array    $members
	 */
	public function create(array $members);

	/**
	 * Get members
	 *
	 * @param  int    $statusId
	 *
	 * @return array
	 */
	public function getMembers($statusId);

	/**
	 * Get simple members
	 *
	 * @return array
	 */
	public function getSimpleMembers();
}