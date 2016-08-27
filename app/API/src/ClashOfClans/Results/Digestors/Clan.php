<?php namespace App\API\src\ClashOfClans\Results\Digestors;

use Carbon\Carbon;
use App\API\src\ClashOfClans\Clan\Saver as ClanSaver;
use App\API\src\ClashOfClans\Members\Creator as MemberCreator;
use App\API\src\ClashOfClans\Results\Fetcher as ResultFetcher;
use App\API\src\ClashOfClans\Members\Details\Creator as MemberDetailCreator;

class Clan {

	/**
	 * @var \App\API\src\ClashOfClans\Results\Fetcher
	 */
	protected $resultFetcher;

	/**
	 * @var \App\API\src\ClashOfClans\Clan\Saver
	 */
	protected $clanSaver;

	/**
	 * @var \App\API\src\ClashOfClans\Members\Creators\Member
	 */
	protected $memberCreator;

	/**
	 * @var \App\API\src\ClashOfClans\Members\Creators\Creator
	 */
	protected $memberDetailCreator;

	/**
	 * @var array
	 */
	protected $members = [];
	protected $clan = [];
	protected $resultIds = [];
	protected $latestResult = [];

	/**
	 * @var \Carbon\Carbon
	 */
	protected $createdAt;

	/**
	 * @param  \App\API\src\ClashOfClans\Results\Fetcher            $resultFetcher
	 * @param  \App\API\src\ClashOfClans\Clan\Saver                 $clanSaver
	 * @param  \App\API\src\ClashOfClans\Members\Creator            $memberCreator
	 * @param  \App\API\src\ClashOfClans\Members\Details\Creator    $memberDetailCreator
	 */
	public function __construct(ResultFetcher $resultFetcher, ClanSaver $clanSaver, MemberCreator $memberCreator, MemberDetailCreator $memberDetailCreator)
	{
		$this->resultFetcher = $resultFetcher;
		$this->clanSaver = $clanSaver;
		$this->memberCreator = $memberCreator;
		$this->memberDetailCreator = $memberDetailCreator;
	}

	/**
	 * Digest clan results
	 *
	 * @return array
	 */
	public function digest()
	{
		//get active clan results
		if (!$results = $this->resultFetcher->getActiveClanResults())
			return;

		//set created date
		$this->createdAt = new Carbon;

		//parse results
		$this->parseResults($results);

		//save clan details
		$this->clanSaver->save($this->clan);

		//create new members if necessary
		if ($uniqueMembers = $this->buildUniqueMembers())
			$this->memberCreator->create($uniqueMembers);

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
		//build member data
		$this->buildMembers($results);

		//build clan data
		$this->buildClan();
	}

	/**
	 * Builds result members
	 *
	 * @param  array    $results
	 */
	protected function buildMembers(array $results)
	{
		foreach ($results as $result)
		{
			$resultId = array_get($result, 'id');
			$this->resultIds[] = $resultId;

			if (!$memberList = array_get($result, 'memberList'))
				continue;

			$this->members = array_merge($this->members, $this->buildMemberList($resultId, $memberList));

			$this->latestResult = $result;
		}

		return $this->members;
	}

	/**
	 * Builds member list
	 *
	 * @param  int      $resultId
	 * @param  array    $members
	 *
	 * @return array
	 */
	protected function buildMemberList($resultId, array $members)
	{
		$memberList = [];

		foreach ($members as $member)
		{
			$memberList[] = $this->buildMember($resultId, $member);
		}

		return $memberList;
	}

	/**
	 * Build member
	 *
	 * @param  int      $resultId
	 * @param  array    $member
	 *
	 * @return array
	 */
	protected function buildMember($resultId, array $member)
	{
		$roleId = config('api.members.roles.' . array_get($member, 'role'));

		return [
			'result_id' => $resultId,
			'tag' => array_get($member, 'tag'),
			'name' => array_get($member, 'name'),
			'role_id' => $roleId,
			'experience' => array_get($member, 'expLevel'),
			'league_id' => array_get($member, 'league.id'),
			'trophies' => array_get($member, 'trophies'),
			'current_rank' => array_get($member, 'clanRank'),
			'previous_rank' => array_get($member, 'previousClanRank'),
			'troops_donated' => array_get($member, 'donations'),
			'troops_received' => array_get($member, 'donationsReceived'),
			'created_at' => $this->createdAt
		];
	}

	/**
	 * Build unique members
	 *
	 * @return array
	 */
	protected function buildUniqueMembers()
	{
		//filter members list to only unique members
		$uniqueMembers = $this->getUniqueMembers();

		return $this->buildNewMembers($uniqueMembers);
	}

	/**
	 * Get unique members
	 *
	 * @return array
	 */
	protected function getUniqueMembers()
	{
		return array_index($this->members, 'tag');
	}

	/**
	 * Builds the new members
	 *
	 * @param  array    $members
	 *
	 * @return array
	 */
	protected function buildNewMembers(array $members)
	{
		$newMembers = [];

		foreach ($members as $member)
		{
			$newMembers[] = [
				'tag' => array_get($member, 'tag'),
				'name' => array_get($member, 'name'),
				'created_at' => array_get($member, 'created_at'),
			];
		}

		return $newMembers;
	}

	/**
	 * Builds member details
	 *
	 * @return array
	 */
	protected function buildMemberDetails()
	{
		$memberDetails = [];

		foreach ($this->members as $member)
		{
			$memberDetails[] = $this->buildMemberDetail($member);
		}

		return $memberDetails;
	}

	/**
	 * Build the member detail
	 *
	 * @param  array    $member
	 *
	 * @return array
	 */
	protected function buildMemberDetail(array $member)
	{
		return [
			'result_id' => array_get($member, 'result_id'),
			'tag' => array_get($member, 'tag'),
			'role_id' => array_get($member, 'role_id'),
			'experience' => array_get($member, 'experience'),
			'league_id' => array_get($member, 'league_id'),
			'trophies' => array_get($member, 'trophies'),
			'current_rank' => array_get($member, 'current_rank'),
			'previous_rank' => array_get($member, 'previous_rank'),
			'troops_donated' => array_get($member, 'troops_donated'),
			'troops_received' => array_get($member, 'troops_received'),
			'created_at' => array_get($member, 'created_at')
		];
	}

	/**
	 * Builds clan details
	 */
	protected function buildClan()
	{
		$this->clan = [
			'tag' => array_get($this->latestResult, 'tag'),
            'name' => array_get($this->latestResult, 'name'),
            'type' => array_get($this->latestResult, 'type'),
            'description' => array_get($this->latestResult, 'description'),
            'location_id' => array_get($this->latestResult, 'location.id'),
            'badge_small' => array_get($this->latestResult, 'badgeUrls.small'),
            'badge_large' => array_get($this->latestResult, 'badgeUrls.large'),
            'badge_medium' => array_get($this->latestResult, 'badgeUrls.medium'),
            'level' => array_get($this->latestResult, 'clanLevel'),
            'points' => array_get($this->latestResult, 'clanPoints'),
            'required_trophies' => array_get($this->latestResult, 'requiredTrophies'),
            'war_frequency' => array_get($this->latestResult, 'war.frequency'),
            'war_win_streak' => array_get($this->latestResult, 'war.win_streak'),
            'war_wins' => array_get($this->latestResult, 'war.wins'),
            'war_ties' => array_get($this->latestResult, 'war.ties'),
            'war_losses' => array_get($this->latestResult, 'war.losses'),
            'members' => array_get($this->latestResult, 'members'),
		];
	}

}