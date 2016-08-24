<?php namespace App\API\src\ClashOfClans\Members\Storage\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\API\src\ClashOfClans\Leagues\Storage\Entities\League;
use App\API\src\ClashOfClans\Members\Storage\Entities\Member;
use App\API\src\ClashOfClans\Members\Details\Storage\Entities\Role;

class Formatter {

	/**
	 * Format members
	 *
	 * @param  \Illuminate\Database\Eloquent\Collection    $members
	 *
	 * @return array
	 */
	public function formatMembers(Collection $members)
	{
		$formatted = [];

		foreach ($members as $member)
		{
			$formatted[] = $this->formatMember($member);
		}

		$sorted = array_values(array_sort($formatted, function ($value)
		{
    		return array_get($value, 'rank.current');
		}));

		return $sorted;
	}

	/**
	 * Format members
	 *
	 * @param  \App\API\src\ClashOfClans\Members\Storage\Entities\Member    $member
	 *
	 * @return array
	 */
	public function formatMember(Member $member)
	{
		return [
			'id' => object_get($member, 'id'),
			'tag' => object_get($member, 'tag'),
			'name' => object_get($member, 'name'),
			'experience' => object_get($member, 'currentDetails.experience'),
			'trophies' => object_get($member, 'currentDetails.trophies'),
			'role' => $this->formatRole(object_get($member, 'currentDetails.role')),
			'league' => $this->formatLeague(object_get($member, 'currentDetails.league')),
			'rank' => [
				'current' => object_get($member, 'currentDetails.current_rank'),
				'previous' => object_get($member, 'currentDetails.previous_rank')
			],
			'troops' => [
				'donated' => object_get($member, 'currentDetails.troops_donated'),
				'received' => object_get($member, 'currentDetails.troops_received')
			]
		];
	}

	/**
	 * Format simple members
	 *
	 * @param  \Illuminate\Database\Eloquent\Collection    $members
	 *
	 * @return array
	 */
	public function formatSimpleMembers(Collection $members)
	{
		$formatted = [];

		foreach ($members as $member)
		{
			$formatted[] = $this->formatSimpleMember($member);
		}

		return $formatted;
	}

	/**
	 * Format members
	 *
	 * @param  \App\API\src\ClashOfClans\Members\Storage\Entities\Member    $member
	 *
	 * @return array
	 */
	public function formatSimpleMember(Member $member)
	{
		return [
			'id' => object_get($member, 'id'),
			'tag' => object_get($member, 'tag'),
			'name' => object_get($member, 'name')
		];
	}

	/**
	 * Format role
	 *
	 * @param  \App\API\src\ClashOfClans\Members\Storage\Entities\Role    $role
	 *
	 * @return array
	 */
	protected function formatRole(Role $role)
	{
		return [
			'id' => $role->getKey(),
			'name' => object_get($role, 'name')
		];
	}

	/**
	 * Format league
	 *
	 * @param  \App\API\src\ClashOfClans\Leagues\Storage\Entities\League    $league
	 *
	 * @return array
	 */
	protected function formatLeague(League $league)
	{
		return [
			'id' => $league->getKey(),
			'name' => object_get($league, 'name'),
			'icon' => [
				'tiny' => object_get($league, 'tiny_icon'),
				'small' => object_get($league, 'small_icon')
			]
		];
	}

}