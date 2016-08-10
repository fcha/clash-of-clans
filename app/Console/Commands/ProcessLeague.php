<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\API\src\ClashOfClans\Results\Fetcher;
use App\API\src\ClashOfClans\Results\Updater as ResultUpdater;
use App\API\src\ClashOfClans\Leagues\Storage\Repositories\RepositoryInterface as LeagueSaver;

class ProcessLeague extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coc:processLeague';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process most recent active league information retrieved from SuperCell\'s API';

    /**
     * @var \App\API\src\ClashOfClans\Results\Fetcher
     */
    protected $fetcher;

    /**
     * @var \App\API\src\ClashOfClans\Leagues\Storage\Repositories\RepositoryInterface
     */
    protected $leagueSaver;

    /**
     * @var \App\API\src\ClashOfClans\Results\Updater
     */
    protected $resultUpdater;

    /**
     * @var Carbon
     */
    protected $date;

    /**
     * @param \App\API\src\ClashOfClans\Results\Fetcher                                     $fetcher
     * @param \App\API\src\ClashOfClans\Leagues\Storage\Repositories\RepositoryInterface    $leagueSaver
     * @param \App\API\src\ClashOfClans\Results\Updater                                     $resultUpdater
     */
    public function __construct(Fetcher $fetcher, LeagueSaver $leagueSaver, ResultUpdater $resultUpdater)
    {
        parent::__construct();

        $this->fetcher = $fetcher;
        $this->leagueSaver = $leagueSaver;
        $this->resultUpdater = $resultUpdater;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //retrieve the most recent active league results
        if (!$result = $this->fetcher->getMostRecentActiveLeagueResults())
            return;

        $resultId = $result['id'];

        //build the league inserts
        if (!$leagues = $this->buildLeagueInserts($resultId, $result['items']))
            return;

        //insert the leagues
        $this->leagueSaver->saveLeagues($leagues);

        //complete league result
        $this->resultUpdater->completeResults([$resultId]);
    }

    /**
     * Builds the league inserts
     *
     * @param  int      $resultId
     * @param  array    $leagues
     *
     * @return array
     */
    protected function buildLeagueInserts($resultId, array $leagues)
    {
        $inserts = [];
        $this->date = new Carbon;

        foreach ($leagues as $league)
        {
            $inserts[] = $this->buildLeagueInsert($resultId, $league);
        }

        return $inserts;
    }

    /**
     * Build the member insert
     *
     * @param  int      $resultId
     * @param  array    $league
     *
     * @return array
     */
    protected function buildLeagueInsert($resultId, array $league)
    {
        return [
            'result_id' => $resultId,
            'unique_id' => array_get($league, 'id'),
            'name' => array_get($league, 'name'),
            'small_icon' => array_get($league, 'iconUrls.small'),
            'tiny_icon' => array_get($league, 'iconUrls.tiny'),
            'created_at' => $this->date
        ];
    }
}
