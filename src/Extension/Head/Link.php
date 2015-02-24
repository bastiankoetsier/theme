<?php namespace Bkoetsier\Theme\Extension\Head;

use Illuminate\Contracts\Support\Renderable;

class Link implements Renderable{

    /**
     * @var string
     */
    protected $rel;
    /**
     * @var string
     */
    protected $href;
    /**
     * @var string|null
     */
    protected $type;
    /**
     * @var string|null
     */
    protected $media;
    /**
     * @var string|null
     */
    protected $hrefLang;

    /**
     * @param string $rel
     * @param  string $href
     * @param string|null $type
     * @param string|null $media
     * @param string|null $hrefLang
     */
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

    /**
     * @return string
     */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @return null|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return null|string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @return null|string
     */
    public function getHrefLang()
    {
        return $this->hrefLang;
    }

    /**
     * @return string
     */
    protected function compileRel()
	{
		return sprintf('rel="%s"',$this->rel);
	}

    /**
     * @return string
     */
    protected function compileHref()
	{
		return sprintf('href="%s"',$this->href);
	}

    /**
     * @return string
     */
    protected function compileType()
	{
		if(is_null($this->type)){
			return '';
		}
		return sprintf('type="%s"',$this->type);
	}

    /**
     * @return string
     */
    protected function compileMedia()
	{
		if (is_null($this->media)) {
			return '';
		}
		return sprintf('media="%s"', $this->media);
	}

}