<?php

namespace GSoares\RAP\Factory;

use GSoares\RAP\Map\AbstractParam;

/**
 * Class RequestPrimitiveValueFactory
 *
 * @package GSoares\RAP\Factory
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class RequestPrimitiveValueFactory
{

    /**
     * @param AbstractParam $param
     * @param string|int|float|array $paramValue
     * @return string|int|float|array
     * @throws RequiredParameterMissingException
     * @throws InvalidConfigurationException
     */
    public function create(AbstractParam $param, $paramValue)
    {
        if (empty($paramValue) && $param->isRequired()) {
            throw new RequiredParameterMissingException($param->getName());
        }

        if (!$param->isArray()) {
            return $paramValue;
        }

        if (!is_array($paramValue)) {
            throw new InvalidConfigurationException(
                'Invalid configuration "' . $paramValue . '" for parameter "' . $param->getName() . '"'
            );
        }

        return $paramValue;
    }
} 