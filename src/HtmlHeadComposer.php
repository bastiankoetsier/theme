<?php namespace Bkoetsier\Theme;

use Bkoetsier\Theme\Extension\Head\Container;
use Illuminate\Contracts\View\View;

class HtmlHeadComposer
{
    private $head;

    function __construct(Container $head)
    {
        $this->head = $head;
    }

    public function compose(View $view)
    {
        $view->with('HtmlHead',$this->head);
    }
}