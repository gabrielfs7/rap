<?php
namespace GSoares\RAP\Factory;

use GSoares\RAP\Map\Resource;

/**
 * Class ResourceMappedFactoryTest
 *
 * @package GSoares\RAP\Factory
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
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

    public function tearDown()
    {
        $this->factory = null;

        parent::tearDown();
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

