<?php namespace App\API\src\ClashOfClans\Results\Digestors;

use Carbon\Carbon;
use App\API\src\ClashOfClans\Wars\Saver as WarSaver;
use App\API\src\ClashOfClans\Results\Fetcher as ResultFetcher;

class War {

	/**
	 * @var \App\API\src\ClashOfClans\Results\Fetcher
	 */
	protected $resultFetcher;

	/**
	 * @var \App\API\src\ClashOfClans\Wars\Saver
	 */
	protected $warSaver;

	/**
	 * @var array
	 */
	protected $wars = [];
	protected $clans = [];
	protected $resultIds = [];

	/**
	 * @var \Carbon\Carbon
	 */
	protected $createdAt;

	/**
	 * @param  \App\API\src\ClashOfClans\Results\Fetcher    $resultFetcher
	 * @param  \App\API\src\ClashOfClans\Wars\Saver          $warSaver
	 */
	public function __construct(ResultFetcher $resultFetcher, WarSaver $warnSaver)
	{
		$this->resultFetcher = $resultFetcher;
		$this->warnSaver = $warnSaver;
	}

	/**
	 * Digest war results
	 *
	 * @return array
	 */
	public function digest()
	{
		//get active war results
		if (!$results = $this->resultFetcher->getRecentActiveWarResults())
			return;

		//set created date
		$this->createdAt = new Carbon;

		//parse results
		$this->parseResults($results);

		//create new members if necessary
		if ($uniqueWars = $this->buildUniqueWars())
		{
			debug_object($uniqueWars, true);
			$this->warSaver->save($uniqueWars);
		}

		//create member details if necessary
		if ($memberDetails = $this->buildMemberDetails())
			$this->memberDetailCreator->create($memberDetails);

		return $this->resultIds;
	}

	/**
	 * Parse results
	 *
	 * @param  array    $results
	 */
	protected function parseResults(array $results)
	{
		foreach ($results as $result)
		{
			$resultId = array_get($result, 'id');
			$this->resultIds[] = $resultId;

			if (!$wars = array_get($result, 'items'))
				continue;

			$this->wars = array_merge($this->wars, $this->buildWars($resultId, $wars));
		}
	}

	/**
	 * Build wars
	 *
	 * @param  int      $resultId
	 * @param  array    $wars
	 */
	protected function buildWars($resultId, array $wars)
	{
		$formattedWars = [];

		foreach ($wars as $war)
		{
			$formattedWars[] = $this->buildWar($resultId, $war);
		}

		return $formattedWars;
	}

	/**
	 * Build war
	 *
	 * @param  int      $resultId
	 * @param  array    $war
	 *
	 * @return array
	 */
	protected function buildWar($resultId, array $war)
	{
		return [
			'result_id' => $resultId,
			'result' => array_get($war, 'result'),
			'end_time' => array_get($war, 'endTime'),
			'team_size' => array_get($war, 'teamSize'),
			'clan' => [
				'tag' => array_get($war, 'clan.tag'),
				'name' => array_get($war, 'clan.name'),
				'level' => array_get($war, 'clan.clanLevel'),
				'attacks' => array_get($war, 'clan.attacks'),
				'stars' => array_get($war, 'clan.stars'),
				'destruction_percentage' => array_get($war, 'clan.destructionPercentage'),
				'exp_earned' => array_get($war, 'clan.expEarned'),
				'badge_small' => array_get($war, 'clan.badgeUrls.small'),
				'badge_medium' => array_get($war, 'clan.badgeUrls.medium'),
				'badge_large' => array_get($war, 'clan.badgeUrls.large'),
			],
			'opponent' => [
				'tag' => array_get($war, 'opponent.tag'),
				'name' => array_get($war, 'opponent.name'),
				'level' => array_get($war, 'opponent.clanLevel'),
				'stars' => array_get($war, 'opponent.stars'),
				'destruction_percentage' => array_get($war, 'opponent.destructionPercentage'),
				'exp_earned' => array_get($war, 'opponent.expEarned'),
				'badge_small' => array_get($war, 'opponent.badgeUrls.small'),
				'badge_medium' => array_get($war, 'opponent.badgeUrls.medium'),
				'badge_large' => array_get($war, 'opponent.badgeUrls.large'),
			],
			'created_at' => $this->createdAt
		];
	}

	/**
	 * Build unique wars
	 *
	 * @return array
	 */
	protected function buildUniqueWars()
	{
		$formattedWars = [];
		$wars = array_index($this->wars, 'endTime');

		foreach ($wars as $war)
		{
			$formattedWars[] = $this->formatWar($war);
		}

		return $formattedWars;
	}

	/**
	 * Format war
	 *
	 * @param  array    $war
	 *
	 * @return array
	 */
	protected function formatWar(array $war)
	{
		return [
			'result_id' => array_get($war, 'result_id'),
			'result' => array_get($war, 'result'),
			'end_time' => array_get($war, 'end_time'),
			'team_size' => array_get($war, 'team_size'),
			'created_at' => array_get($war, 'created_at')
		];
	}

}