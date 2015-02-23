<?php namespace Bkoetsier\Theme\Facade;

use Illuminate\Support\Facades\Facade;

class HtmlHead extends Facade{


	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'theme.html.head'; }


}