<?php namespace Bkoetsier\Theme;

use Illuminate\Filesystem\FilesystemAdapter;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem as Flysystem;

class ManagerTest extends \TestCase {

    /**
     * @var Manager
     */
    protected $sut;

    public function setUp()
    {
        $viewPath = __DIR__.'/stubs/themes';
        $files = new FilesystemAdapter(new Flysystem(new Local(__DIR__)));
        parent::setUp();
        $this->sut = new Manager(
            $files,
            $this->app->make('view'),
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
