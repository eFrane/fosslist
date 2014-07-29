<?php namespace EFrane\Fosslist;

use Illuminate\Support\ServiceProvider;

use EFrane\Fosslist\Commands\CacheCommand;
use EFrane\Fosslist\Commands\ListCommand;

class FosslistServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('efrane/fosslist');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$store = new DependencyStore;

		$this->app['fosslist'] = $this->app->share(function($app) use ($store) {
			return new Fosslist($app['view'], $store);
		});

		$this->app['fosslist_cache_command'] = $this->app->share(function($app) use ($store) {
			return new CacheCommand($store);
		});

		$this->app['fosslist_list_command'] = $this->app->share(function($app) use ($store) {
			return new ListCommand($app['view'], $store);
		});

		$this->commands(['fosslist_cache_command', 'fosslist_list_command']);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
