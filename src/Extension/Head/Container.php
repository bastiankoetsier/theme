<?php namespace Bkoetsier\Theme\Extension\Head;

use Bkoetsier\Theme\Extension\Script;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Illuminate\View\Compilers\BladeCompiler;

class Container
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $lines;

    function __construct()
    {
        $this->lines = new Collection(
            array(
                'title' => new Title(''),
                'meta' => new Collection,
                'style' => new Collection,
                'script' => new Collection,
                'link' => new Collection
            )
        );
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getLines()
    {
        return $this->lines;
    }

    /** This is executed through Blade´s extend-method
     * @param $viewContent
     * @param \Illuminate\View\Compilers\BladeCompiler $compiler
     * @return string
     */
    public function __invoke($viewContent, BladeCompiler $compiler)
    {
        $replacement = '';
        $pattern = $compiler->createPlainMatcher('head');
        foreach ($this->lines as $key => $value) {
            switch (true) {
                case $value instanceof Collection:
                    $replacement .= $this->compileCollection($value);
                    break;
                case $value instanceof Renderable:
                    $replacement .= $value->render();
                    break;
                default:
                    throw new \InvalidArgumentException("$value");
            }
        }
        return preg_replace($pattern, $replacement, $viewContent);
    }

    /**
     * Compiles the replacement string of a collection
     * @param \Illuminate\Support\Collection $collection
     * @return string
     */
    protected function compileCollection(Collection $collection)
    {
        $compiledString = '';
        foreach ($collection as $entry) {
            if ( ! $entry instanceof Renderable) {
                throw new \InvalidArgumentException("Entry is no instance of Renderable");
            }
            /* @var $entry Renderable */
            $compiledString .= $entry->render();
        }
        return $compiledString;
    }

    /**
     * Set the title-attribute
     * @param string $title
     * @return $this
     */
    public function title($title)
    {
        $this->lines->put('title', new Title($title));
        return $this;
    }

    /**
     * Add a stylesheet to the header
     * @param string $stylesheetUrl
     * @param null|string $media
     * @return \Bkoetsier\Theme\Extension\Head\Container
     */
    public function stylesheet($stylesheetUrl, $media = null)
    {
        return $this->link('stylesheet', $stylesheetUrl, 'text/css', $media);
    }

    /**
     * Set the canonical link
     * @param string $href
     * @return $this
     */
    public function canonical($href)
    {
        $links = $this->lines->get('link');
        $links->push(new Link('canonical', $href));
        return $this;
    }

    /**
     * Add a javascript to the header
     * @param string $src
     * @param bool $defer
     * @param bool $asnyc
     * @return $this
     */
    public function script($src, $defer = false, $asnyc = false)
    {
        $scripts = $this->lines->get('script');
        $scripts->push(new Script($src, 'text/javascript', $defer, $asnyc));
        return $this;
    }

    /**
     * @param string $rel
     * @param string $href
     * @param null|string $type
     * @param null|string $media
     * @return $this
     */
    protected function link($rel, $href, $type = null, $media = null)
    {
        $links = $this->lines->get('link');
        $links->push(new Link($rel, $href, $type, $media));
        return $this;
    }

    /**
     * Add a meta tag to the header
     * @param string $name
     * @param string $content
     * @return $this
     */
    public function meta($name, $content)
    {
        $meta = $this->lines->get('meta');
        $meta->push(new Meta($name, $content));
        return $this;
    }
    
    /**
     * Set the meta robots tag
     * @param bool $index
     * @param bool $follow
     * @return $this
     */
    public function robots($index = true, $follow = true)
    {
        $meta = $this->lines->get('meta');
        $meta->push(new RobotsMeta($index, $follow));
        return $this;
    }
}
