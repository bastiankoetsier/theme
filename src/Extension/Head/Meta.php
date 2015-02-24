<?php namespace Bkoetsier\Theme\Extension\Head;

use Illuminate\Contracts\Support\Renderable;

class Meta implements Renderable{


    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $content;

    /**
     * @param string $name
     * @param string $content
     */
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

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}