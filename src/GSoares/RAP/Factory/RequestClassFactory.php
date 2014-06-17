<?php

namespace GSoares\RAP\Factory;

use GSoares\RAP\Map\AbstractParam;
use GSoares\RAP\Map\Property;
use GSoares\RAP\Parser\AnnotationParser;
use GSoares\RAP\Parser\AnnotationParserInterface;

/**
 * Class RequestClassFactory
 *
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
     * @param AnnotationParserInterface $annotationParser
     */
    public function __construct(AnnotationParserInterface $annotationParser = null)
    {
        $this->annotationParser = $annotationParser ?: new AnnotationParser();
    }

    /**
     * @param string $className
     * @param array $request
     * @return mixed
     */
    public function create($className, array $request)
    {
        $class = new $className;

        foreach ((new \ReflectionClass($className))->getProperties() as $property) {
            if (!$param = $this->getParamByProperty($property, $request)) {
                continue;
            }

            $value = $this->getValueByRequest($param, $request[$property->getName()]);

            if ($property->isPublic()) {
                $class->{$property->getName()} = $value;

                continue;
            }

            if (method_exists($class, 'set' . $property->getName())) {
                $class->{'set' . $property->getName()}($value);
            }
        }

        return $class;
    }

    /**
     * @param AbstractParam $param
     * @param $requestValue
     * @return array|mixed
     */
    private function getValueByRequest(AbstractParam $param, $requestValue)
    {
        if (!$param->isArray()) {
            if ($param->isClass()) {
                return $this->create($param->getType(), $requestValue);
            }

            return $requestValue;
        }

        if ($param->isClass()) {
            $out = [];

            foreach ($requestValue as $value) {
                $out[] = $this->create($param->getType(), (array) $value);
            }

            return $out;
        }

        return $requestValue;
    }

    /**
     * @param \ReflectionProperty $property
     * @param array $request
     * @return \GSoares\RAP\Map\AbstractParam
     */
    private function getParamByProperty(\ReflectionProperty $property, array $request)
    {
        foreach ($this->annotationParser->parse($property->getDocComment()) as $param) {
            if ($param instanceof Property && array_key_exists($property->getName(), $request)) {
                return $param;
            }
        }
    }
}