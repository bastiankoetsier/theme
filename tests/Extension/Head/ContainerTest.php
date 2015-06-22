<?php
namespace Bkoetsier\Theme\Exception\Head;

use Bkoetsier\Theme\Extension\Head\Container;
use Illuminate\View\Compilers\BladeCompiler;

class ContainerTest extends \PHPUnit_Framework_TestCase{

    /**
     * @var \Bkoetsier\Theme\Extension\Head\Container
     */
    protected $sut;

    public function setUp()
    {
        $this->sut = new Container();
        parent::setUp();
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
        $this->assertInstanceOf('Bkoetsier\Theme\Extension\Head\Container',$this->sut);
    }
    
    /**
     * @test
     */
    public function it_replaces_head_with_title_when_being_invoked()
    {
        $compiler = new BladeCompiler(new \Illuminate\Filesystem\Filesystem,__DIR__);
        $stubContent = '@head';
        $result = call_user_func($this->sut,$stubContent,$compiler);
        $this->assertEquals('<title></title>',$result);
    }

    /**
     * @test
     */
    public function it_returns_an_line_collection_with_five_items()
    {
        $this->assertInstanceOf('Illuminate\Support\Collection',$this->sut->getLines());
        $this->assertEquals(5,$this->sut->getLines()->count());
    }

    /**
     * @test
     */
    public function it_adds_a_title_object_to_line_collection()
    {
        $this->sut->title('test');
        $lines = $this->sut->getLines();
        /** @var \Bkoetsier\Theme\Extension\Head\Title $title */
        $title = $lines->get('title');
        $this->assertInstanceOf('Bkoetsier\Theme\Extension\Head\Title',$title);
        $this->assertEquals('test',$title->getTitle());
    }
    
    /**
     * @test
     */
    public function it_adds_a_link_object_with_rel_canonical_to_line_collection()
    {
        $this->sut->canonical('www.google.de');
        $lines = $this->sut->getLines();
        $links = $lines->get('link');
        /** @var \Bkoetsier\Theme\Extension\Head\Link $canonical */
        $canonical = $links->first();
        $this->assertInstanceOf('Bkoetsier\Theme\Extension\Head\Link',$canonical);
        $this->assertEquals('canonical',$canonical->getRel());
    }
    
    /**
     * @test
     */
    public function it_adds_a_robots_meta_object_to_line_collection()
    {
        $this->sut->robots(true,true);
        $lines = $this->sut->getLines();
        $meta = $lines->get('meta');
        /** @var \Bkoetsier\Theme\Extension\Head\RobotsMeta $robots */
        $robots = $meta->first();
        $this->assertInstanceOf('Bkoetsier\Theme\Extension\Head\RobotsMeta',$robots);
        $this->assertTrue($robots->isIndex());
        $this->assertTrue($robots->isFollow());
    }

}