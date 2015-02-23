<?php namespace Bkoetsier\Theme;

use Bkoetsier\Theme\Exception\TemplateDoesNotExistException;
use Bkoetsier\Theme\Exception\ThemeDoesNotExistException;
use Illuminate\View\Factory;

class Manager {

    protected $activeTheme = 'default';
    protected $themesPath;
    protected $defaultExtension = '.blade.php';

    /**
     * @var \Illuminate\View\Factory
     */
    private $view;

    function __construct( Factory $view, $themesPath)
    {
        $this->themesPath = $themesPath;
        $this->view = $view;
    }

    public function getActive()
    {
        return $this->activeTheme;
    }

    public function setActive($themeName)
    {
        if ( ! $this->themeExists($themeName)){
            throw new ThemeDoesNotExistException("$themeName");
        }
        $this->activeTheme = $themeName;
        $this->view->getFinder()->addLocation($this->getActiveThemePath());
    }

    public function getThemesPath()
    {
        return $this->themesPath;
    }

    public function getActiveThemePath()
    {
        return $this->getThemesPath()
        . DIRECTORY_SEPARATOR
        . strtolower($this->getActive());
    }

    public function make($templateType, $data = array(), $mergeData = array())
    {
        if( ! $this->templateExists($templateType)){
            throw new TemplateDoesNotExistException("$templateType does not exist");
        }
        return call_user_func_array(array($this->view,'make'),array($templateType,$data,$mergeData));
    }

    public function getView()
    {
        return $this->view;
    }

    private function templateExists($templateType)
    {
        $path = $this->getActiveThemePath()
            . DIRECTORY_SEPARATOR
            . $templateType
            . $this->defaultExtension;
        return file_exists($path);
    }

    public function __call($method, array $args)
    {
        if(method_exists($this->view,$method)){
            return call_user_func_array(array($this->view,$method),$args);
        }
        throw new \BadMethodCallException("$method does not exist");
    }

    private function themeExists($themeName)
    {
        $pathToCheck = $this->getThemesPath()
            . DIRECTORY_SEPARATOR
            . strtolower($themeName);
        return file_exists($pathToCheck);
    }

}