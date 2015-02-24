<?php namespace Bkoetsier\Theme\Exception\Head;

use Bkoetsier\Theme\Extension\Head\RobotsMeta;

class RobotsMetaTest extends \PHPUnit_Framework_TestCase{

    /**
     * @var \Bkoetsier\Theme\Extension\Head\RobotsMeta
     */
    protected $sut;

    public function setUp()
    {
        parent::setUp();

    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function it_renders_itself_correctly_index_follow()
    {
        $this->sut = new RobotsMeta($index = true,$follow = true);
        $result = $this->sut->render();
        $expected = '<meta name="robots" content="index,follow">';
        $this->assertEquals($expected,$result);
    }

    /**
     * @test
     */
    public function it_renders_itself_correctly_noindex_follow()
    {
        $this->sut = new RobotsMeta($index = false,$follow = true);
        $result = $this->sut->render();
        $expected = '<meta name="robots" content="noindex,follow">';
        $this->assertEquals($expected,$result);
    }

    /**
     * @test
     */
    public function it_renders_itself_correctly_noindex_nofollow()
    {
        $this->sut = new RobotsMeta($index = false,$follow = false);
        $result = $this->sut->render();
        $expected = '<meta name="robots" content="noindex,nofollow">';
        $this->assertEquals($expected,$result);
    }

    /**
     * @test
     */
    public function it_renders_itself_correctly_index_nofollow()
    {
        $this->sut = new RobotsMeta($index = true,$follow = false);
        $result = $this->sut->render();
        $expected = '<meta name="robots" content="index,nofollow">';
        $this->assertEquals($expected,$result);
    }
}