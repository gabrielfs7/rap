<?php

namespace GSoares\RAP\Map;

/**
 * @package GSoares\RAP\Map
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class ResourceTest extends \PHPUnit_Framework_TestCase
{
    public function testGetUriParamNames()
    {
        $resource = new Resource();
        $resource->setUri('/{version}/api/payment/{paymentId}/capture/{customerId}');

        $this->assertEquals(['version', 'paymentId', 'customerId'], $resource->getUriParamNames());
    }
}
 