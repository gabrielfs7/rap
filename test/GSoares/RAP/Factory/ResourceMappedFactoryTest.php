<?php
namespace GSoares\RAP\Factory;

use GSoares\RAP\Map\Resource;

class ResourceMappedFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ResourceMappedFactory
     */
    private $factory;


    public function setUp()
    {
        $this->factory = new ResourceMappedFactory();

        parent::setUp();
    }

    /**
     * @test
     */
    public function testCreateWithCorrectParams()
    {
        $data = [
	       'help' => 'Help text',
	       'uri' => 'my/uri',
	       'method' => 'POST'
        ];

        $expected = new Resource();
        $expected->setHelp('Help text');
        $expected->setMethod('POST');
        $expected->setUri('my/uri');

        $this->assertEquals($expected, $this->factory->create($data));
    }
}

