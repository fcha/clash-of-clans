<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\API\src\ClashOfClans\Results\Storage\Repositories\Guzzle\RepositoryInterface as Fetcher;
use App\API\src\ClashOfClans\Results\Storage\Repositories\Eloquent\RepositoryInterface as Saver;

class FetchLeague extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coc:fetchLeague';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches and stores league information from SuperCell\'s API';

    /**
     * @var \App\API\src\ClashOfClans\Results\Storage\Repositories\Guzzle\RepositoryInterface
     */
    protected $fetcher;

    /**
     * @var \App\API\src\ClashOfClans\Results\Storage\Repositories\Eloquent\RepositoryInterface
     */
    protected $saver;

    /**
     * @param \App\API\src\ClashOfClans\Results\Storage\Repositories\Guzzle\RepositoryInterface        $fetcher
     * @param \App\API\src\ClashOfClans\Results\Storage\Repositories\Eloquent\RepositoryInterface    $saver
     */
    public function __construct(Fetcher $fetcher, Saver $saver)
    {
        parent::__construct();

        $this->fetcher = $fetcher;
        $this->saver = $saver;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $results = $this->fetcher->getLeagues();

        if ($errors = array_get(json_decode($results, true), 'reason'))
            $this->fail($results);
        else
            $this->success($results);
    }

    /**
     * Failed to retrieve results
     *
     * @param  string    $results
     */
    protected function fail($results)
    {
        $resultTypeId = config('api.results.types.leagues');
        $statusId = config('api.results.statuses.failed');

        $this->saver->saveResults($resultTypeId, $statusId, $results);
    }

    /**
     * Failed to retrieve results
     *
     * @param  string    $results
     */
    protected function success($results)
    {
        $resultTypeId = config('api.results.types.leagues');
        $statusId = config('api.results.statuses.active');

        $this->saver->saveResults($resultTypeId, $statusId, $results);
    }
}
