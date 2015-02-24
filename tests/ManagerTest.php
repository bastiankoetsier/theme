<?php namespace Bkoetsier\Theme;

use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;

class ManagerTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Manager
     */
    protected $sut;

    public function setUp()
    {
        parent::setUp();
        $viewPath = __DIR__.'/stubs/themes';
        $finder = new FileViewFinder(new Filesystem(),array($viewPath));
        $view = new Factory(new EngineResolver,$finder,new Dispatcher);
        $this->sut = new Manager(
            $view,
            $viewPath
        );
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf('\Bkoetsier\Theme\Manager', $this->sut);
    }

    /**
     * @test
     */
    public function it_returns_default_as_default_active_theme_name()
    {
        $this->assertEquals('default', $this->sut->getActive());
    }

    /**
     * @test
     */
    public function it_sets_a_theme_name()
    {
        $this->sut->setActive('testing');
        $this->assertEquals('testing', $this->sut->getActive());
    }
    /**
     * @test
     */
    public function it_returns_the_complete_path_to_currently_active_theme()
    {
        $this->sut->setActive('testing');
        $expectedPath = $this->sut->getThemesPath(). DIRECTORY_SEPARATOR . 'testing';
        $this->assertEquals($expectedPath,$this->sut->getActiveThemePath());
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_theme_does_not_exist()
    {
        $this->setExpectedException('Bkoetsier\Theme\Exception\ThemeDoesNotExistException');
        $this->sut->setActive('nonExistingTheme');
    }


}
