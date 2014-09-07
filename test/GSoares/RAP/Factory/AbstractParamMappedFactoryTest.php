<?php
namespace GSoares\RAP\Factory;

use GSoares\RAP\Map\Param;

/**
 * @package GSoares\RAP\Factory
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class AbstractParamMappedFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractParamMappedFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = $this->getMockForAbstractClass(
            'GSoares\RAP\Factory\AbstractParamMappedFactory'
        );

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
	       'name' => 'myName',
	       'pattern' => '[a-z]',
	       'type' => 'string',
	       'required' => true,
	       'sample' => 'Sample text',
	       'default' => 'Default value'
        ];

        $param = new Param();
        $param->setType('string');
        $param->setHelp('Help text');
        $param->setType('string');
        $param->setDefault('Default value');
        $param->setName('myName');
        $param->setRequired(true);
        $param->setSample('Sample text');
        $param->setPattern('[a-z]');

        $this->assertEquals($param, $this->factory->createByParam($data, new Param()));
    }
}
