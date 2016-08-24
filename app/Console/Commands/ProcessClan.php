<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\API\src\ClashOfClans\Results\Updater as ResultUpdater;
use App\API\src\ClashOfClans\Results\Digestors\Clan as Digestor;

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
	 * @var \App\API\src\ClashOfClans\Results\Digestors\Clan
	 */
	protected $digestor;

	/**
	 * @var \App\API\src\ClashOfClans\Results\Updater
	 */
	protected $resultUpdater;

	/**
	 * @param \App\API\src\ClashOfClans\Results\Fetcher    $digestor
	 * @param \App\API\src\ClashOfClans\Results\Updater    $resultUpdater
	 */
	public function __construct(Digestor $digestor, ResultUpdater $resultUpdater)
	{
		parent::__construct();

		$this->digestor = $digestor;
		$this->resultUpdater = $resultUpdater;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$resultIds = $this->digestor->digest();

		//complete results
		$this->resultUpdater->completeResults($resultIds);
	}

}
