<?php namespace Bkoetsier\Theme\Exception\Head;

use Bkoetsier\Theme\Extension\Head\Link;

class LinkTest extends \PHPUnit_Framework_TestCase{

    /**
     * @var \Bkoetsier\Theme\Extension\Head\Link
     */
    protected $sut;

    public function setUp()
    {
        $this->sut = new Link($rel = 'stylesheet', $href = 'style.css', $type = 'text/css', $media = 'display');
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function it_renders_itself_correctly()
    {
        $result = $this->sut->render();
        $expected = '<link rel="stylesheet" href="style.css" type="text/css" media="display">';
        $this->assertEquals($expected,$result);
    }
}