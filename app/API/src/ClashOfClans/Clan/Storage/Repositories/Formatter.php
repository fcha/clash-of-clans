<?php namespace App\API\src\ClashOfClans\Clan\Storage\Repositories;

use App\API\src\ClashOfClans\Clan\Storage\Entities\Clan;

class Formatter {

	/**
	 * Format members
	 *
	 * @param  \App\API\src\ClashOfClans\Clan\Storage\Entities\Clan    $clan
	 *
	 * @return array
	 */
	public function formatClan(Clan $clan)
	{
		return [
			'location' => [
				'id' => object_get($clan, 'location.id'),
				'name' => object_get($clan, 'location.name'),
			],
			'members' => object_get($clan, 'members'),
			'level' => object_get($clan, 'level'),
			'points' => object_get($clan, 'points'),
			'required_trophies' => object_get($clan, 'required_trophies'),
			'war' => [
				'win_streak' => object_get($clan, 'war_win_streak'),
				'wins' => object_get($clan, 'war_wins'),
				'ties' => object_get($clan, 'war_ties'),
				'losses' => object_get($clan, 'war_losses'),
				'frequency' => object_get($clan, 'war_frequency')
			],
			'tag' => object_get($clan, 'tag'),
			'name' => object_get($clan, 'name'),
			'type' => $this->formatType(object_get($clan, 'type')),
			'badge' => [
				'small' => object_get($clan, 'badge_small'),
				'medium' => object_get($clan, 'badge_medium'),
				'large' => object_get($clan, 'badge_large')
			],
			'description' => object_get($clan, 'description'),
		];
	}

	/**
	 * Format type
	 *
	 * @param  string    $type
	 *
	 * @return array
	 */
	protected function formatType($type)
	{
		$type = snake_case($type);

		return ucwords(str_replace('_', ' ', $type));
	}

}