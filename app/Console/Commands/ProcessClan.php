<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\API\src\ClashOfClans\Results\Fetcher;
use App\API\src\ClashOfClans\Results\Updater as ResultUpdater;
use App\API\src\ClashOfClans\Members\Storage\Repositories\RepositoryInterface as MemberSaver;

class ProcessClan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coc:processClan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process all active clan information retrieved from SuperCell\'s API';

    /**
     * @var \App\API\src\ClashOfClans\Results\Fetcher
     */
    protected $fetcher;

    /**
     * @var \App\API\src\ClashOfClans\Members\Storage\Repositories\RepositoryInterface
     */
    protected $memberSaver;

    /**
     * @var \App\API\src\ClashOfClans\Results\Updater
     */
    protected $resultUpdater;

    /**
     * @var Carbon
     */
    protected $date;

    /**
     * @var array
     */
    protected $resultIds;

    /**
     * @param \App\API\src\ClashOfClans\Results\Fetcher                                     $fetcher
     * @param \App\API\src\ClashOfClans\Members\Storage\Repositories\RepositoryInterface    $memberSaver
     * @param \App\API\src\ClashOfClans\Results\Updater                                     $resultUpdater
     */
    public function __construct(Fetcher $fetcher, MemberSaver $memberSaver, ResultUpdater $resultUpdater)
    {
        parent::__construct();

        $this->fetcher = $fetcher;
        $this->memberSaver = $memberSaver;
        $this->resultUpdater = $resultUpdater;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$results = $this->fetcher->getActiveClanResults())
            return;

        if (!$members = $this->buildMemberInserts($results))
            return;

        $this->memberSaver->saveMembers($members);

        $this->resultUpdater->completeResults($this->resultIds);
    }

    /**
     * Builds the member inserts
     *
     * @param  array    $results
     *
     * @return array
     */
    protected function buildMemberInserts(array $results)
    {
        $inserts = [];
        $this->date = new Carbon;

        foreach ($results as $result)
        {
            if (!$memberList = array_get($result, 'memberList'))
                continue;

            $inserts = array_merge($inserts, $this->buildMemberListInsert($result['id'], $memberList));
            $this->resultIds[] = $result['id'];
        }

        return $inserts;
    }

    /**
     * Builds the member list inserts
     *
     * @param  int      $resultId
     * @param  array    $members
     *
     * @return array
     */
    protected function buildMemberListInsert($resultId, array $members)
    {
        $inserts = [];

        foreach ($members as $member)
        {
            $inserts[] = $this->buildMemberInsert($resultId, $member);
        }

        return $inserts;
    }

    /**
     * Build the member insert
     *
     * @param  int      $resultId
     * @param  array    $member
     *
     * @return array
     */
    protected function buildMemberInsert($resultId, array $member)
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
            'created_at' => $this->date
        ];
    }
}
