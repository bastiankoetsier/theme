<?php namespace Bkoetsier\Theme\Facade;

use Bkoetsier\Theme\Extension\Head\Container;
use Illuminate\Support\Facades\Facade;

class HtmlHead extends Facade{


	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return Container::class; }


}