<?php namespace Bkoetsier\Theme;

use Bkoetsier\Theme\Exception\TemplateDoesNotExistException;
use Bkoetsier\Theme\Exception\ThemeDoesNotExistException;
use Illuminate\View\Factory;

class Manager {

    /**
     * @var string
     */
    protected $activeTheme = 'default';
    /**
     * @var string
     */
    protected $themesPath;
    /**
     * @var string
     */
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

    /**
     * @return string
     */
    public function getActive()
    {
        return $this->activeTheme;
    }

    /**
     * @param string $themeName
     * @throws \Bkoetsier\Theme\Exception\ThemeDoesNotExistException
     */
    public function setActive($themeName)
    {
        if ( ! $this->themeExists($themeName)){
            throw new ThemeDoesNotExistException("$themeName");
        }
        $this->activeTheme = $themeName;
        $this->view->getFinder()->addLocation($this->getActiveThemePath());
    }

    /**
     * @return string
     */
    public function getThemesPath()
    {
        return $this->themesPath;
    }

    /**
     * @return string
     */
    public function getActiveThemePath()
    {
        return $this->getThemesPath()
        . DIRECTORY_SEPARATOR
        . strtolower($this->getActive());
    }

    /**
     * @param $templateType
     * @param array $data
     * @param array $mergeData
     * @return mixed
     * @throws \Bkoetsier\Theme\Exception\TemplateDoesNotExistException
     */
    public function make($templateType, $data = array(), $mergeData = array())
    {
        if( ! $this->templateExists($templateType)){
            throw new TemplateDoesNotExistException("$templateType does not exist");
        }
        dump($this->view->getEngineResolver()->resolve('blade')->getCompiler());
        return call_user_func_array(array($this->view,'make'),array($templateType,$data,$mergeData));
    }

    /**
     * @return \Illuminate\View\Factory
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param string $templateType
     * @return bool
     */
    private function templateExists($templateType)
    {
        $path = $this->getActiveThemePath()
            . DIRECTORY_SEPARATOR
            . $templateType
            . $this->defaultExtension;
        return file_exists($path);
    }

    /**
     * @param $method
     * @param array $args
     * @return mixed
     */
    public function __call($method, array $args)
    {
        if(method_exists($this->view,$method)){
            return call_user_func_array(array($this->view,$method),$args);
        }
        throw new \BadMethodCallException("$method does not exist");
    }

    /**
     * @param $themeName
     * @return bool
     */
    private function themeExists($themeName)
    {
        $pathToCheck = $this->getThemesPath()
            . DIRECTORY_SEPARATOR
            . strtolower($themeName);
        return file_exists($pathToCheck);
    }

}