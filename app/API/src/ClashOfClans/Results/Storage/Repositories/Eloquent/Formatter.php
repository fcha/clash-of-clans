<?php namespace App\API\src\ClashOfClans\Results\Storage\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Collection;

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
			$clanResult = json_decode($result->result, true);
			$clanResult['requestedAt'] = $result->created_at;
			$clanResult['id'] = $result->getKey();
			$formatted[] = $clanResult;
		}

		return $formatted;
	}

}