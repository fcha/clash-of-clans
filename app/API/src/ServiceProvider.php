<?php namespace App\API\src;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
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
		$this->app->register('App\API\src\ClashOfClans\ServiceProvider');
	}

}