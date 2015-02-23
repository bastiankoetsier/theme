<?php namespace Bkoetsier\Theme\Extension;

use Illuminate\Contracts\Support\Renderable;

class Script implements Renderable{

	protected $src,
		$type,
		$defer,
		$async;

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

	private function compileSrc()
	{
		return sprintf('src="%s"',$this->src);
	}

	private function compileType()
	{
		return sprintf('type="%s"',$this->type);
	}

	private function compileDefer()
	{
		if( ! $this->defer){
			return '';
		}
		return 'defer';
	}

	private function compileAsync()
	{
		if( ! $this->async){
			return '';
		}
		return 'async';
	}
}