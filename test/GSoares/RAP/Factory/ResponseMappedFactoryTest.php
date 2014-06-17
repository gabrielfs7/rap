<?php
namespace GSoares\RAP\Factory;

use GSoares\RAP\Map\Response;
use GSoares\RAP\Map\Param;

/**
 * Class ResponseMappedFactoryTest
 *
 * @package GSoares\RAP\Factory
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class ResponseMappedFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ResponseMappedFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new ResponseMappedFactory();

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
	       'status' => 200,
	       'return' => 'string',
	       'method' => 'POST'
        ];

        $param = new Param();
        $param->setType('string');

        $expected = new Response();
        $expected->setHelp('Help text');
        $expected->setStatus(200);
        $expected->setReturn('string');
        $expected->addParam($param);

        $this->assertEquals($expected, $this->factory->create($data));
    }
}
