<?php namespace App\API\src\ClashOfClans\Results\Storage\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Collection;
use App\API\src\ClashOfClans\Results\Storage\Entities\Result;

class Formatter {

	/**
	 * Format results
	 *
	 * @param  \Illuminate\Database\Eloquent\Collection    $results
	 *
	 * @return array
	 */
	public function formatResults(Collection $results)
	{
		$formatted = [];

		foreach ($results as $result)
		{
			$formatted[] = $this->formatResult($result);
		}

		return $formatted;
	}

	/**
	 * Format results
	 *
	 * @param  \App\API\src\ClashOfClans\Results\Storage\Entities\Result    $result
	 *
	 * @return array
	 */
	public function formatResult(Result $result)
	{
		$clanResult = json_decode($result->result, true);
		$clanResult['requestedAt'] = $result->created_at;
		$clanResult['id'] = $result->getKey();

		return $clanResult;
	}

}