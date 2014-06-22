<?php

namespace GSoares\RAP\Request;

use GSoares\RAP\Map\Property;
use GSoares\RAP\Parser\AnnotationParser;
use GSoares\RAP\Parser\AnnotationParserInterface;

/**
 * Class RequestPropertyParamFinder
 *
 * @package GSoares\RAP\Factory
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class RequestPropertyParamFinder
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
     * @param \ReflectionProperty $property
     * @param array $request
     * @return \GSoares\RAP\Map\AbstractParam
     */
   public function find(\ReflectionProperty $property, array $request)
    {
        foreach ($this->annotationParser->parse($property->getDocComment()) as $param) {
            if ($param instanceof Property && array_key_exists($property->getName(), $request)) {
                return $param;
            }
        }
    }
}