<?php

namespace GSoares\RAP\Factory;


/**
 * Class RequestClassFactory
 *
 * @package GSoares\RAP\Factory
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class RequestClassFactory
{

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
        //TODO Incompleted method

        foreach ($reflectionClass->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            if (array_key_exists($property->getName(), $request) &&
                $property->getName() == $request[$property->getName()]) {
                $class->{$property->getName()} = $request[$property->getName()];
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
        //TODO Incompleted method

        foreach ($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            $paramName = str_replace('set', '', $method->getName());

            if (array_key_exists($paramName, $request) &&
                strcasecmp($method->getName(), 'set' . $paramName) === 0) {
                $class->{$method->getName()}($request[$paramName]);
            }
        }
    }
}