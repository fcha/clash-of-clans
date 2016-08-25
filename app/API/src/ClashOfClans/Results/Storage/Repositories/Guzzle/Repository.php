<?php namespace App\API\src\ClashOfClans\Results\Storage\Repositories\Guzzle;

use GuzzleHttp\Client;

class Repository implements RepositoryInterface {

	/**
	 * @var bool
	 */
	protected $debug = false;

	/**
	 * @var curl
	 */
	protected $curl;

	/**
	 * @param  bool    $debug
	 */
	public function __construct($debug = false)
	{
		$this->debug = $debug;
	}

	/**
	 * Get clan information
	 *
	 * @return string
	 */
	public function getClan()
	{
		$clanTag = $this->getClanTag();
		$url = "https://api.clashofclans.com/v1/clans/{$clanTag}";

		return $this->makeApiCall($url);
	}

	/**
	 * Get league information
	 *
	 * @return string
	 */
	public function getLeagues()
	{
		$url = "https://api.clashofclans.com/v1/leagues";

		return $this->makeApiCall($url);
	}

	/**
	 * Get location information
	 *
	 * @return string
	 */
	public function getLocations()
	{
		$url = "https://api.clashofclans.com/v1/locations";

		return $this->makeApiCall($url);
	}

	/**
	 * Get clan warlog information
	 *
	 * @return string
	 */
	public function getWarLog()
	{
		$clanTag = $this->getClanTag();
		$url = "https://api.clashofclans.com/v1/clans/{$clanTag}/warlog";

		return $this->makeApiCall($url);
	}

	/**
	 * Get clan tag
	 *
	 * @return string
	 */
	protected function getClanTag()
	{
		return urlencode(env("SUPERCELL_CLAN_TAG"));
	}

	/**
	 * Make API call
	 *
	 * @param  string     $url
	 *
	 * @return string
	 */
	protected function makeApiCall($url)
	{
		$client = new Client;

		$response = $client->request('GET', $url, [
			'headers' => $this->getHeaders()
		]);

		$statusCode = $response->getStatusCode();

		if ($statusCode == 200)
			return $response->getBody()->getContents();
		else
			throw new Exception("Error code: {$statusCode}");
	}

	/**
	 * Get the headers
	 *
	 * @return array
	 */
	protected function getHeaders()
	{
		$token = env('SUPERCELL_TOKEN');

		return [
			'Accept' => 'application/json',
			'authorization' => "Bearer {$token}"
		];
	}

}