<?php namespace App\API\src\ClashOfClans\Results\Storage\Repositories\cURL;

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
	 * @return array
	 */
	public function getClan()
	{
		$clanTag = urlencode(env("SUPERCELL_CLAN_TAG"));
		$url = "https://api.clashofclans.com/v1/clans/{$clanTag}";

		return $this->execute($url);
	}

	/**
	 * Get clan information
	 *
	 * @return array
	 */
	public function getLeagues()
	{
		$url = "https://api.clashofclans.com/v1/leagues";

		return $this->execute($url);
	}

	/**
	 * Executes curl with the provided url
	 *
	 * @param  string	$url
	 *
	 * @return string
	 */
	protected function execute($url)
	{
		//Initialize curl
		$this->initialize();

		//Set the url
		curl_setopt($this->curl , CURLOPT_URL, $url);

		//Set verbose option for debuggine curl calls
		if ($this->debug)
		{
			curl_setopt($this->curl, CURLOPT_VERBOSE, true);
			curl_setopt($this->curl , CURLOPT_HEADER, true);
		}

		$response = curl_exec($this->curl);

		//Get and display errors and response
		if ($this->debug)
		{
			debug_object(curl_error($this->curl));
			debug_object($response);
		}

		//Close curl connection
		curl_close($this->curl);

		return $response;
	}

	/**
	 * Initializes curl
	 *
	 * @return void
	 */
	protected function initialize()
	{
		$this->curl = curl_init();

		//Set curl options
		curl_setopt($this->curl , CURLOPT_TIMEOUT, 30);
		curl_setopt($this->curl , CURLOPT_HTTPHEADER, $this->getHeaders());
		curl_setopt($this->curl , CURLOPT_RETURNTRANSFER, 1);
	}

	/**
	 * Get the headers
	 *
	 * @return array
	 */
	public function getHeaders()
	{
		$token = env('SUPERCELL_TOKEN');

		return ['Accept: application/json', "authorization: Bearer {$token}"];
	}
}