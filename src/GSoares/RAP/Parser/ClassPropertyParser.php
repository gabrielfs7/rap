<?php

namespace GSoares\RAP\Parser;

use GSoares\RAP\Map\AbstractParam;
use GSoares\RAP\Map\Property;
use GSoares\RAP\Parser\AnnotationParser;
use GSoares\RAP\Parser\AnnotationParserInterface;
use GSoares\RAP\Request\RequestParamRetriever;

/**
 * Class ClassPropertyParser
 *
 * @package GSoares\RAP\Factory
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class ClassPropertyParser
{

    /**
     * @var \GSoares\RAP\Parser\AnnotationParser
     */
    private $annotationParser;

    /**
     * @param AnnotationParserInterface $annotationParser
     */
    public function __construct(AnnotationParserInterface $annotationParser = null)
    {
        $this->annotationParser = $annotationParser ?: new AnnotationParser();
    }

    /**
     * @param $object
     * @param \ReflectionProperty $property
     * @param $value
     */
    public function parse($object, \ReflectionProperty $property, $value)
    {
        if ($property->isPublic()) {
            $object->{$property->getName()} = $value;
        }

        if (method_exists($object, 'set' . $property->getName())) {
            $object->{'set' . $property->getName()}($value);
        }
    }
}