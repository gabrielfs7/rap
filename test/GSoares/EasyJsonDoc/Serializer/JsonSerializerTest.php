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
        $this->markTestIncomplete('See how to compare entire JSON...');

        $filler = new JsonSerializer();

        $filler->serialize('\Sample\User');
    }
}

