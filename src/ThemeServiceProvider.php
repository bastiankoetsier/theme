<?php namespace Bkoetsier\Theme;

use Bkoetsier\Theme\Extension\Head\Container;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// get the BladeCompiler to extend it with HtmlHead
        $bladeCompiler = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();
        $bladeCompiler->extend($this->app['theme.html.head']);

        $this->publishes([
            __DIR__ . '/config/themes.php' => $this->app->make('path.config').'/themes.php'
        ]);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerThemeManager();

		$this->registerHtmlHead();

		$this->registerFacades();

	}

	protected function registerFacades()
	{
		AliasLoader::getInstance()->alias(
			'Theme',
			'Bkoetsier\Theme\Facade\Theme'
		);
		AliasLoader::getInstance()->alias(
			'HtmlHead',
			'Bkoetsier\Theme\Facade\HtmlHead'
		);
	}

	protected function registerHtmlHead()
	{
		$this->app->singleton(
			'theme.html.head',
			function ($app) {
				return new Container;
			}
		);
	}

	protected function registerThemeManager()
	{
		$this->app->singleton(
			'theme.manager',
			function ($app) {
				$viewPath = $app['config']->get('themes.folder');
				return new Manager(
					$app->make('view'),
					$viewPath
				);
			}
		);
	}

}