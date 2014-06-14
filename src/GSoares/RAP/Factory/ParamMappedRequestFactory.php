<?php
namespace GSoares\RAP\Factory;

use GSoares\RAP\Exception\InvalidConfigurationException;
use GSoares\RAP\Exception\RequiredParameterMissingException;
use GSoares\RAP\Map\AbstractParam;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ParamMappedRequestFactory
 *
 * @package GSoares\RAP\Factory
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class ParamMappedRequestFactory
{

    /**
     * @var ParamMappedFactory
     */
    private $paramMappedFactory;

    public function __construct(ParamMappedFactory $paramMappedFactory = null)
    {
        $this->paramMappedFactory = $paramMappedFactory ?: new ParamMappedFactory();
    }

    public function create(Request $request, AbstractParam $param)
    {
        $paramValue = $request->get($param->getName());

        if ($param->isPrimitive()) {
            if (!$param->isArray()) {
                return $paramValue;
            }

            if (!is_array($paramValue)) {
                throw new InvalidConfigurationException(
                    'Invalid configuration "' . $paramValue . '" for parameter "' . $param->getName() . '"'
                );
            }

            if (empty($paramValue) && $param->isRequired()) {
                throw new RequiredParameterMissingException($param->getName());
            }

            return $paramValue;
        }

        if ($param->isClass()) {
            return $this->createClass($param->getType(), $paramValue);
        }
    }

    /**
     * @param $className
     * @param array $request
     * @return object
     */
    private function createClass($className, array $request)
    {
        //TODO FIXME Incomplete method...

        $reflection = new \ReflectionClass($className);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);
        $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);

        $class = new $className;

        foreach ($properties as $property) {
            if (array_key_exists($property->getName(), $request) &&
                $property->getName() == $request[$property->getName()]) {
                $class->{$property->getName()} = $request[$property->getName()];
            }
        }

        foreach ($methods as $method) {
            $paramName = str_replace('set', '', $method->getName());

            if (array_key_exists($paramName, $request) &&
                strcasecmp($method->getName(), 'set' . $paramName) === 0) {
                $class->{$method->getName()}($request[$paramName]);
            }
        }

        return $class;
    }
}