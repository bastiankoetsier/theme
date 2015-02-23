<?php namespace Bkoetsier\Theme\Extension\Head;

use Illuminate\Contracts\Support\Renderable;

class Link implements Renderable{

	protected $rel,
	 	$href,
	 	$type,
		$media,
		$hrefLang;

	function __construct($rel, $href, $type = null, $media = null, $hrefLang = null)
	{
		$this->rel = $rel;
		$this->href = $href;
		$this->type = $type;
		$this->media = $media;
		$this->hrefLang = $hrefLang;
	}


	/**
	 * Get the evaluated contents of the object.
	 *
	 * @return string
	 */
	public function render()
	{
		return sprintf('<link %s %s %s %s>',
			$this->compileRel(),
			$this->compileHref(),
			$this->compileType(),
			$this->compileMedia()
		);
	}

	protected function compileRel()
	{
		return sprintf('rel="%s"',$this->rel);
	}

	protected function compileHref()
	{
		return sprintf('href="%s"',$this->href);
	}

	protected function compileType()
	{
		if(is_null($this->type)){
			return '';
		}
		return sprintf('type="%s"',$this->type);
	}

	protected function compileMedia()
	{
		if (is_null($this->media)) {
			return '';
		}
		return sprintf('media="%s"', $this->media);
	}

}