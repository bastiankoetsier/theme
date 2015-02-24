<?php namespace Bkoetsier\Theme\Extension\Head;

use Illuminate\Contracts\Support\Renderable;

class Title implements Renderable{

    /**
     * @var string
     */
    protected $title;

    /**
     * @param string $title
     */
    function __construct($title)
	{
		$this->title = $title;
	}

	/**
	 * Get the evaluated contents of the object.
	 *
	 * @return string
	 */
	public function render()
	{
		return sprintf('<title>%s</title>',$this->title);
	}
}