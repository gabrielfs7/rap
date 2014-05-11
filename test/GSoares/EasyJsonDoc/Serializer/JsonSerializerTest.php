<?php
namespace GSoares\EasyJsonDoc\Serializer;

require __DIR__ . '/../../../Sample/User.php';
require __DIR__ . '/../../../Sample/Status.php';
require __DIR__ . '/../../../Sample/Group.php';

/**
 * PrimitiveValueFiller test case.
 */
class JsonSerializerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Tests PrimitiveValueFiller->fill()
     */
    public function testSerialize()
    {
        $filler = new JsonSerializer();

        var_dump($filler->serialize('\Sample\User'));

        $this->markTestIncomplete('See how to compare entire JSON...'); //FIXME
    }
}

