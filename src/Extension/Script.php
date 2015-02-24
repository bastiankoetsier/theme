<?php namespace Bkoetsier\Theme\Extension;

use Illuminate\Contracts\Support\Renderable;

class Script implements Renderable{

    /**
     * @var string
     */
    protected $src;
    /**
     * @var string
     */
    protected $type;
    /**
     * @var bool
     */
    protected $defer;
    /**
     * @var bool
     */
    protected $async;

    /**
     * @param $src
     * @param string $type
     * @param bool $defer
     * @param bool $async
     */
    function __construct($src,$type = 'text/javascript', $defer = false, $async = false)
	{
		$this->src = $src;
		$this->defer = $defer;
		$this->type = $type;
		$this->async = $async;
	}

	/**
	 * Get the evaluated contents of the object.
	 *
	 * @return string
	 */
	public function render()
	{
		return sprintf('<script %s %s %s %s></script>',
			$this->compileSrc(),
			$this->compileType(),
			$this->compileDefer(),
			$this->compileAsync()
		);
	}

    /**
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return boolean
     */
    public function isDefer()
    {
        return $this->defer;
    }

    /**
     * @return boolean
     */
    public function isAsync()
    {
        return $this->async;
    }

    /**
     * @return string
     */
    private function compileSrc()
	{
		return sprintf('src="%s"',$this->src);
	}

    /**
     * @return string
     */
    private function compileType()
	{
		return sprintf('type="%s"',$this->type);
	}

    /**
     * @return string
     */
    private function compileDefer()
	{
		if( ! $this->defer){
			return '';
		}
		return 'defer';
	}

    /**
     * @return string
     */
    private function compileAsync()
	{
		if( ! $this->async){
			return '';
		}
		return 'async';
	}
}