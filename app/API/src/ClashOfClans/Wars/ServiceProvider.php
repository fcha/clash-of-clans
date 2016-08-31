<?php namespace App\API\src\ClashOfClans\Wars;

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
			'App\API\src\ClashOfClans\Wars\Storage\Repositories\RepositoryInterface',
			'App\API\src\ClashOfClans\Wars\Storage\Repositories\Repository'
		);
	}

}