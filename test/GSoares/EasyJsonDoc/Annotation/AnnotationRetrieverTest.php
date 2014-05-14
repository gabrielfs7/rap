<?php
namespace GSoares\EasyJsonDoc\Serializer;

use GSoares\EasyJsonDoc\Annotation\AnnotationRetriever;
use GSoares\EasyJsonDoc\Annotation\Annotation;
require __DIR__ . '/../../../Sample/User.php';
require __DIR__ . '/../../../Sample/Status.php';
require __DIR__ . '/../../../Sample/Group.php';

/**
 * AnnotationRetriever test case.
 */
class AnnotationRetrieverTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Tests PrimitiveValueFiller->fill()
     */
    public function testRetrieve()
    {
        $docComment = [];
        $docComment[] = '**/';
        $docComment[] = '* @var string Comment here';
        $docComment[] = '* @param string Comment here';
        $docComment[] = '* @EasyJsonDoc/Sample Sample here';
        $docComment[] = '* return Sample\User User data';
        $docComment[] = '*/';

        $annotationVar = new Annotation();
        $annotationVar->name = '@var';
        $annotationVar->value = 'string';
        $annotationVar->comment = 'Comment here';

        $annotationSample = new Annotation();
        $annotationSample->name = '@EasyJsonDoc/Sample';
        $annotationSample->value = 'Sample here';

        $annotationParam = new Annotation();
        $annotationParam->name = '@param';
        $annotationParam->value = 'string';
        $annotationParam->comment = 'Comment here';

        $annotationReturn = new Annotation();
        $annotationReturn->name = 'return';
        $annotationReturn->value = 'Sample\User';
        $annotationReturn->comment = 'User data';

        $filler = new AnnotationRetriever();
        $annotations = $filler->retrieve(implode(PHP_EOL, $docComment));

        $this->assertEquals($annotationVar, $annotations[0]);
        $this->assertEquals($annotationParam, $annotations[1]);
        $this->assertEquals($annotationSample, $annotations[2]);
        $this->assertEquals($annotationReturn, $annotations[3]);
    }
}

