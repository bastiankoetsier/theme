<?php namespace Bkoetsier\Theme\Extension\Head;

use Illuminate\Contracts\Support\Renderable;

class Meta implements Renderable{


	protected $name;
	protected $content;

	function __construct($name, $content)
	{
		$this->name = $name;
		$this->content = $content;
	}


	/**
	 * Get the evaluated contents of the object.
	 *
	 * @return string
	 */
	public function render()
	{
		return sprintf('<meta name="%s" content="%s">',$this->name,$this->content);
	}
}