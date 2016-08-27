<?php namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\API\src\ClashOfClans\Results\Fetcher;
use App\API\src\ClashOfClans\Results\Updater as ResultUpdater;
use App\API\src\ClashOfClans\Locations\Storage\Repositories\RepositoryInterface as LocationSaver;

class ProcessLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coc:processLocation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process most recent active location information retrieved from SuperCell\'s API';

    /**
     * @var \App\API\src\ClashOfClans\Results\Fetcher
     */
    protected $fetcher;

    /**
     * @var \App\API\src\ClashOfClans\Locations\Storage\Repositories\RepositoryInterface
     */
    protected $locationSaver;

    /**
     * @var \App\API\src\ClashOfClans\Results\Updater
     */
    protected $resultUpdater;

    /**
     * @var Carbon
     */
    protected $date;

    /**
     * @param \App\API\src\ClashOfClans\Results\Fetcher                                       $fetcher
     * @param \App\API\src\ClashOfClans\Locations\Storage\Repositories\RepositoryInterface    $locationSaver
     * @param \App\API\src\ClashOfClans\Results\Updater                                       $resultUpdater
     */
    public function __construct(Fetcher $fetcher, LocationSaver $locationSaver, ResultUpdater $resultUpdater)
    {
        parent::__construct();

        $this->fetcher = $fetcher;
        $this->locationSaver = $locationSaver;
        $this->resultUpdater = $resultUpdater;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //retrieve the most recent active location results
        if (!$result = $this->fetcher->getRecentActiveLocationResults())
            return;

        $resultId = $result['id'];

        //build the location inserts
        if (!$locations = $this->buildLocationInserts($resultId, $result['items']))
            return;

        //insert the locations
        $this->locationSaver->saveLocations($locations);

        //complete location result
        $this->resultUpdater->completeResults([$resultId]);
    }

    /**
     * Builds the location inserts
     *
     * @param  int      $resultId
     * @param  array    $locations
     *
     * @return array
     */
    protected function buildLocationInserts($resultId, array $locations)
    {
        $inserts = [];
        $this->date = new Carbon;

        foreach ($locations as $location)
        {
            $inserts[] = $this->buildLocationInsert($resultId, $location);
        }

        return $inserts;
    }

    /**
     * Build the member insert
     *
     * @param  int      $resultId
     * @param  array    $location
     *
     * @return array
     */
    protected function buildLocationInsert($resultId, array $location)
    {
        return [
            'result_id' => $resultId,
            'unique_id' => array_get($location, 'id'),
            'name' => array_get($location, 'name'),
            'is_country' => array_get($location, 'isCountry'),
            'created_at' => $this->date
        ];
    }
}
