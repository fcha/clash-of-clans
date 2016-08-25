<?php namespace App\API\src\ClashOfClans\Results;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider {

	/**
	 * Register the service provider.
	 */
	public function register()
	{
		$this->registerRepositories();
	}

	/**
	 * Registers the offer repository
	 */
	protected function registerRepositories()
	{
		$this->app->singleton(
			'App\API\src\ClashOfClans\Results\Storage\Repositories\Guzzle\RepositoryInterface',
			'App\API\src\ClashOfClans\Results\Storage\Repositories\Guzzle\Repository'
		);

		$this->app->singleton(
			'App\API\src\ClashOfClans\Results\Storage\Repositories\Eloquent\RepositoryInterface',
			'App\API\src\ClashOfClans\Results\Storage\Repositories\Eloquent\Repository'
		);
	}

}