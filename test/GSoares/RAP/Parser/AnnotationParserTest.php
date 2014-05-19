<?php
namespace GSoares\RAP\Parser;

require __DIR__ . '/../../../Sample/Dtos.php';
require __DIR__ . '/../../../Sample/RestService.php';

/**
 * PrimitiveValueFiller test case.
 */
class AnnotationParserTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Tests PrimitiveValueFiller->fill()
     */
    public function testSerialize()
    {
        $reflection = new \ReflectionMethod('Sample\RestService::get');

        $filler = new AnnotationParser();

        var_dump($filler->parse($reflection->getDocComment()));

        $this->markTestIncomplete('See how to compare entire JSON...'); //FIXME
    }
}

