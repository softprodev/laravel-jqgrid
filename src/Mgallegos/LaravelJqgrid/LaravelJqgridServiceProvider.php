<?php
/**
 * @file
 * LaravelJqGrid Service Provider.
 *
 * All LaravelJqGrid code is copyright by the original authors and released under the MIT License.
 * See LICENSE.
 */

namespace Mgallegos\LaravelJqgrid;

use Mgallegos\LaravelJqgrid\Renders\Validations\ColModel\NameValidation;

use Illuminate\Support\ServiceProvider;

class LaravelJqgridServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('mgallegos/laravel-jqgrid');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->register('Maatwebsite\Excel\ExcelServiceProvider');

		$this->registerRender();

		$this->registerEncoder();
	}

	/**
	 * Register render service provider.
	 *
	 * @return void
	 */
	public function registerRender()
	{
		$this->app->bind('gridrender', function($app)
		{
			return new Renders\JqGridRender(	array(),
												array(new NameValidation()),
												array(),
												array(),
												$app['config']->get('laravel-jqgrid::default_grid_options'),
												$app['config']->get('laravel-jqgrid::default_pivot_grid_options'),
												$app['config']->get('laravel-jqgrid::default_group_header_options'),
												$app['config']->get('laravel-jqgrid::default_col_model_properties'),
												$app['config']->get('laravel-jqgrid::default_navigator_options'),
												$app['config']->get('laravel-jqgrid::default_filter_toolbar_options'),
												$app['config']->get('laravel-jqgrid::default_filter_toolbar_buttons_options'),
												$app['config']->get('laravel-jqgrid::default_export_buttons_options'),
												$app['config']->get('laravel-jqgrid::default_file_properties'),
												$app['config']->get('laravel-jqgrid::default_sheet_properties'),
												$app['config']->get('laravel-jqgrid::function_type_properties'),
												$app['config']->get('laravel-jqgrid::pivot_options'),
												$app['config']->get('laravel-jqgrid::group_header_options'),
												$app['session']->token()
											);
		});
	}

	/**
	 * Register encoder service provider.
	 *
	 * @return void
	 */
	public function registerEncoder()
	{
		$this->app->bind('Mgallegos\LaravelJqgrid\Encoders\RequestedDataInterface', function($app)
		{
			return new Encoders\JqGridJsonEncoder($app->make('excel'));
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('gridrender', 'Mgallegos\LaravelJqgrid\Encoders\RequestedDataInterface');
	}

}
