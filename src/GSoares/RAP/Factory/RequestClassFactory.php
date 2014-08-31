<?php

namespace GSoares\RAP\Factory;

use GSoares\RAP\Map\AbstractParam;
use GSoares\RAP\Parser\AnnotationParser;
use GSoares\RAP\Parser\AnnotationParserInterface;
use GSoares\RAP\Parser\ClassPropertyParser;
use GSoares\RAP\Request\RequestPropertyParamFinder;

/**
 * @package GSoares\RAP\Factory
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class RequestClassFactory
{

    /**
     * @var \GSoares\RAP\Parser\AnnotationParser
     */
    private $annotationParser;

    /**
     * @var ClassPropertyParser
     */
    private $classPropertyParser;

    /**
     * @var RequestPropertyParamFinder
     */
    private $requestPropertyParamFinder;

    public function __construct(
        AnnotationParserInterface $annotationParser = null,
        RequestPropertyParamFinder $requestPropertyParamFinder = null,
        ClassPropertyParser $classPropertyParser = null
    ) {
        $this->classPropertyParser = $classPropertyParser ?: new ClassPropertyParser();
        $this->annotationParser = $annotationParser ?: new AnnotationParser();
        $this->requestPropertyParamFinder = $requestPropertyParamFinder ?: new RequestPropertyParamFinder();
    }

    /**
     * @param string $className
     * @param array $request
     * @return mixed
     */
    public function create($className, array $request)
    {
        $object = new $className;

        foreach ((new \ReflectionClass($className))->getProperties() as $property) {
            if ($param = $this->requestPropertyParamFinder->find($property, $request)) {
                $this->fillObject($object, $param, $property, $request);
            }
        }

        return $object;
    }

    /**
     * @param $object
     * @param AbstractParam $param
     * @param \ReflectionProperty $property
     * @param array $request
     */
    private function fillObject($object, AbstractParam $param, \ReflectionProperty $property, array $request)
    {
        $this->classPropertyParser->parse($object, $property, $this->getValueByRequest($param, $request));
    }

    /**
     * @param AbstractParam $param
     * @param array $request
     * @return array|mixed
     */
    private function getValueByRequest(AbstractParam $param, array $request)
    {
        $requestValue = $request[$param->getName()];

        if ($param->isArray() && $param->isClass()) {
            return $this->createClassArrayValue($requestValue, $param);
        }

        if ($param->isClass()) {
            return $this->create($param->getType(), $requestValue);
        }

        return $requestValue;
    }

    /**
     * @param array $requestValue
     * @param AbstractParam $param
     * @return array
     */
    private function createClassArrayValue(array $requestValue, AbstractParam $param)
    {
        $out = [];

        foreach ($requestValue as $value) {
            $out[] = $this->create($param->getType(), (array) $value);
        }

        return $out;
    }
}