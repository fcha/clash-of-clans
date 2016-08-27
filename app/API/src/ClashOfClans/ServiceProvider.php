<?php namespace App\API\src\ClashOfClans;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider {

	/**
	 * Register the service provider.
	 */
	public function register()
	{
		$this->registerServiceProviders();
	}

	/**
	 * register service providers
	 */
	protected function registerServiceProviders()
	{
		$this->app->register('App\API\src\ClashOfClans\Clan\ServiceProvider');
		$this->app->register('App\API\src\ClashOfClans\Leagues\ServiceProvider');
		$this->app->register('App\API\src\ClashOfClans\Locations\ServiceProvider');
		$this->app->register('App\API\src\ClashOfClans\Members\ServiceProvider');
		$this->app->register('App\API\src\ClashOfClans\Results\ServiceProvider');
	}

}