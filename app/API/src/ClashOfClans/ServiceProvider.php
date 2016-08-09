<?php namespace App\API\src\ClashOfClans;

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
			'App\API\src\ClashOfClans\Storage\Repositories\cURL\RepositoryInterface',
			'App\API\src\ClashOfClans\Storage\Repositories\cURL\Repository'
		);

		$this->app->singleton(
			'App\API\src\ClashOfClans\Storage\Repositories\Eloquent\RepositoryInterface',
			'App\API\src\ClashOfClans\Storage\Repositories\Eloquent\Repository'
		);
	}

}