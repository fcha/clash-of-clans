<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\API\src\ClashOfClans\Results\Storage\Repositories\cURL\RepositoryInterface as Fetcher;
use App\API\src\ClashOfClans\Results\Storage\Repositories\Eloquent\RepositoryInterface as Saver;

class FetchClan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coc:fetchClan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches and stores clan information from SuperCell\'s API';

    /**
     * @var \App\API\src\ClashOfClans\Results\Storage\Repositories\cURL\RepositoryInterface
     */
    protected $fetcher;

    /**
     * @var \App\API\src\ClashOfClans\Results\Storage\Repositories\Eloquent\RepositoryInterface
     */
    protected $saver;

    /**
     * @param \App\API\src\ClashOfClans\Results\Storage\Repositories\cURL\RepositoryInterface        $fetcher
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
     *
     * @return mixed
     */
    public function handle()
    {
        $results = $this->fetcher->getClan();

        $clanResultTypeId = config('api.results.types.clans');

        $this->saver->saveResults($clanResultTypeId, $results);
    }
}
