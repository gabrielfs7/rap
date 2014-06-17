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
        $reflectionClass = new \ReflectionClass($className);

        $this->fillProperties($reflectionClass, $class, $request);
        $this->fillMethods($reflectionClass, $class, $request);

        return $class;
    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @param string $class
     * @param array $request
     */
    private function fillProperties(\ReflectionClass $reflectionClass, $class, array $request)
    {
        foreach ($reflectionClass->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            if (array_key_exists($property->getName(), $request)) {
                $class->{$property->getName()} = $this->getValueByRequest(
                    $this->getPropertyByAnnotation($property->getDocComment()),
                    $request[$property->getName()]
                );
            }
        }
    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @param string $class
     * @param array $request
     */
    private function fillMethods(\ReflectionClass $reflectionClass, $class, array $request)
    {
        //TODO FIXME Methods implementation...

        foreach ($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            $paramName = str_replace('set', '', $method->getName());

            if (array_key_exists($paramName, $request) &&
                strcasecmp($method->getName(), 'set' . $paramName) === 0) {
                $class->{$method->getName()}($request[$paramName]);
            }
        }
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
     * @param $annotationComment
     * @return \GSoares\RAP\Map\Property
     */
    private function getPropertyByAnnotation($annotationComment)
    {
        foreach ($this->annotationParser->parse($annotationComment) as $property) {
            if ($property instanceof Property) {
                return $property;
            }
        }
    }
}