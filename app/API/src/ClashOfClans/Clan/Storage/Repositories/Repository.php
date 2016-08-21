<?php namespace App\API\src\ClashOfClans\Clan\Storage\Repositories;

use App\API\src\ClashOfClans\Clan\Storage\Entities\Clan;

class Repository implements RepositoryInterface {

	/**
	 * @var  \App\API\src\ClashOfClans\Clan\Storage\Entities\Clan
	 */
	protected $clan;

	/**
	 * @var  \Formatter
	 */
	protected $formatter;

	/**
	 * @param  Formatter    $formatter
	 */
	public function __construct(Formatter $formatter)
	{
		$this->clan = new Clan;
		$this->formatter = $formatter;
	}

	/**
	 * Save clan
	 *
	 * @param  array    $clanDetails
	 */
	public function save(array $clanDetails)
	{
		if (!$clan = $this->clan->first())
			$clan = new Clan;

		$clan->location_id = array_get($clanDetails, 'location_id');
		$clan->members = array_get($clanDetails, 'members');
		$clan->clan_level = array_get($clanDetails, 'clan_level');
		$clan->clan_points = array_get($clanDetails, 'clan_points');
		$clan->required_trophies = array_get($clanDetails, 'required_trophies');
		$clan->war_win_streak = array_get($clanDetails, 'war_win_streak');
		$clan->war_wins = array_get($clanDetails, 'war_wins');
		$clan->war_ties = array_get($clanDetails, 'war_ties');
		$clan->war_losses = array_get($clanDetails, 'war_losses');
		$clan->war_frequency = array_get($clanDetails, 'war_frequency');
		$clan->tag = array_get($clanDetails, 'tag');
		$clan->name = array_get($clanDetails, 'name');
		$clan->type = array_get($clanDetails, 'type');
		$clan->badge_small = array_get($clanDetails, 'badge_small');
		$clan->badge_medium = array_get($clanDetails, 'badge_medium');
		$clan->badge_large = array_get($clanDetails, 'badge_large');
		$clan->description = array_get($clanDetails, 'description');

		$clan->save();
	}

}