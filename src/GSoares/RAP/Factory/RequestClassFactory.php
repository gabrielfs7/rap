<?php

namespace GSoares\RAP\Factory;

use GSoares\RAP\Map\AbstractParam;
use GSoares\RAP\Map\Property;
use GSoares\RAP\Parser\AnnotationParser;
use GSoares\RAP\Parser\AnnotationParserInterface;
use GSoares\RAP\Parser\ClassPropertyParser;
use GSoares\RAP\Request\RequestPropertyParamFinder;

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
                $value = $this->getValueByRequest($param, $request[$property->getName()]);

                $this->classPropertyParser->parse($object, $property, $value);
            }
        }

        return $object;
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
}